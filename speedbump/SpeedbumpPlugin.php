<?php
namespace Craft;

class SpeedbumpPlugin extends BasePlugin
{

	public function getName()
	{
		return 'Speedbump';
	}

	public function getDescription()
	{
		return 'Alerts users when navigating to any un-whitelisted links.';
	}

	public function getVersion()
	{
		return '0.0.2';
	}

	public function getSchemaVersion()
	{
		return '0.0.0';
	}

	public function getDeveloper()
	{
		return 'STAPLEGUN';
	}

	public function getDeveloperUrl()
	{
		return 'http://staplegun.us';
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('speedbump/_settings', array(
			'settings' => $this->getSettings()
		));
	}

	public function init()
	{
		if (! craft()->request->isCpRequest()) {
			craft()->templates->includeJsFile(UrlHelper::getResourceUrl('speedbump/js/speedbump.min.js'));
			craft()->templates->includeCssFile(UrlHelper::getResourceUrl('speedbump/css/speedbump.css'));
			craft()->templates->hook('speedbump', function(&$context)
			{
				$response = craft()->speedbump->getSpeedbumpHtml();
				return $response;
			});
		}
	}

	protected function defineSettings()
	{
		return array(
			'speedbumpText' => array(AttributeType::String, 'label' => 'Speedbump Text'),
			'useClassOnly' => array(AttributeType::Bool, 'label' => 'Only Use Class', 'default' => false),
			'whitelist' => array(AttributeType::String, 'label' => 'Whitelist'),
			'proceedButtonText' => array(AttributeType::String, 'label' => 'Proceed Button Text', 'default' => 'Accept'),
			'remainButtonText' => array(AttributeType::String, 'label' => 'Remain Button Text', 'default' => 'Cancel')
		);
	}

}
