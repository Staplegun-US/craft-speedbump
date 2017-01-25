<?php
namespace Craft;

class SpeedbumpService extends BaseApplicationComponent
{
	protected function getSettings()
	{
		return craft()->plugins->getPlugin('speedbump')->getSettings();
	}

	public function getSpeedbumpHtml()
	{
		$oldPath = craft()->path->getTemplatesPath();

		$newPath = craft()->path->getPluginsPath() . 'speedbump/templates/';
		craft()->path->setTemplatesPath($newPath);

		$templateName = '_speedbump';

		$settings = craft()->speedbump->getSettings();
		$htmlResponse = craft()->templates->render($templateName, array("settings" => $settings));

		craft()->path->setTemplatesPath($oldPath);

		return $htmlResponse;
	}

}
