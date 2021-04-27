<?php

	class Items {

		public $settings, $types, $db;

		public function __construct() {
			global $db, $page;
			$this->db = $db;
			$this->page = $page;
			$this->settings = new Settings();
			$types = $this->settings->loadSetting("itemTypes");
			$this->types = $types;

			if (!$this->types) $this->types = array();
		}

		public function getSlots($user) {
			$hook = new Hook("equipSlot");
        	$slots = $this->page->sortArray($hook->run());
        	$equipSlots = array();

        	foreach ($slots as $slot) {
        		$equipSlots[] = array(
        			"name" => $slot["name"],
        			"item" => $slot["getItem"]($user), 
        			"actions" => $slot
        		);
        	}
        	return $equipSlots;
		}

		public function getEffects() {
			$hook = new Hook("itemEffects");
			$effects = $hook->run();
			return $effects;
		}

		public function findEffect($effects, $effect) {
			foreach ($effects as $value) {
				if ($value["name"] == $effect) {
					return $value;
				}
			}
		}

		public function getItem($id) {
			if (!$id) return false; 
			$item = $this->db->select("
				SELECT 
					I_id as 'id', 
					I_name as 'name', 
					I_type as 'type'
				FROM items 
				WHERE I_id = :id
			", array(
				":id" => $id
			));

			if (!$item) return false;

			$meta = $this->db->selectAll("
				SELECT * FROM itemMeta WHERE IM_item = :item
			", array(
				":item" => $item["id"]
			));

			foreach ($meta as $key => $value) {
				$item[$value["IM_meta"]] = $value["IM_value"];
			}


			$item["effects"] = $this->db->selectAll("
				SELECT
					IE_effect as 'effect',
					IE_item as 'item',
					IE_value as 'value',
					IE_desc as 'desc'
				FROM itemEffects WHERE IE_item = :item
			", array(
				":item" => $item["id"]
			));

			return $item;
		}

		public function getType($name, $id = false) {
			if ($id) {
				foreach ($this->types as $t) {
					if ($t["id"] == $id) {
						return $t;
					}
				}
				return false;
			}
			foreach ($this->types as $t) {
				if ($t["name"] == $name) {
					return $t;
				}
			}
			return false;
		}

		public function registerNewType($name, $type) {
			$exists = false;
			$id = 1;
			foreach ($this->types as $t) {
				if ($t["name"] == $name) {
					$exists = true;
				}
				$id++;
			}
			if (!$exists) {
				$this->types[] = array(
					"id" => $id, 
					"name" => $name, 
					"type" => $type
				);
				$this->settings->update("itemTypes", $this->types);
			}
		}
	}