<?php
namespace Zeuxisoo\Core;

class Depender {

	protected $container = array();

	public function __set($name, $item) {
		$this->container[$name] = $item;
	}

	public function __get($name) {
		return $this->container[$name];
	}

	public function __unset($name) {
		if (array_key_exists($name, $this->container) === true) {
			unset($this->container[$name]);
		}
	}

	public function get($name) {
		return $this->$name;
	}

	public function set($name, $item) {
		$this->$name = $item;
	}

	public function act($item) {
		if (is_string($item) === true) {
			return $this->container[$item];
		}

		if (is_callable($item) === true) {
			$method = new \ReflectionFunction($item);

			$parameters = array();
			foreach($method->getParameters() as $parameter) {
				$name = $parameter->name;
				$parameters[] = array_key_exists($name, $this->container) === true ? $this->container[$name] : null;
			}

			return call_user_func_array($item, $parameters);
		}
	}

	public function del($name) {
		unset($this->$name);
	}

}
