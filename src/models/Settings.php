<?php
/**
 * Speedbump plugin for Craft CMS 3.x
 *
 * Alerts users when navigating to any un-whitelisted links.
 *
 * @link      https://staplegun.us
 * @copyright Copyright (c) 2019 STAPLEGUN
 */

namespace staplegun\speedbump\models;

use staplegun\speedbump\Speedbump;

use Craft;
use craft\base\Model;

/**
 * @author    STAPLEGUN
 * @package   Speedbump
 * @since     0.0.3
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $speedbumpText = '';

    /**
     * @var string
     */
    public $whitelist = '';

    /**
     * @var string
     */
    public $proceedButtonText = '';

    /**
     * @var string
     */
    public $remainButtonText = '';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['speedbumpText', 'string'],
            ['whitelist', 'string'],
            ['proceedButtonText', 'string'],
            ['proceedButtonText', 'default', 'value' => 'Accept'],
            ['remainButtonText', 'string'],
            ['remainButtonText', 'default', 'value' => 'Cancel']
        ];
    }
}