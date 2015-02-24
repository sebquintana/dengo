<?php namespace Dengo\Core;

use App;

trait CommandBus {

	public function execute($command)
	{
		return $this->getCommandBus()->execute($command);
	}

	public function getCommandBus()
	{
		return App::make('Laracasts\Commander\CommandBus');
	}
}