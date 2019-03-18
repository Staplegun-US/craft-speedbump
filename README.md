# Speedbump for Craft CMS 3.x

A a11y compliant plugin for Craft CMS that displays a dialog to users when navigating off-site.

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require staplegun/craft-speedbump

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Speedbump.

## Settings

### Speedbump Text

The message that's displayed within the dialog.

### Use Only Class

When enabled, the speedbump will be displayed only on links with the `require-speedbump` class.

### Whitelist

The domains that are excepted from displaying the dialog. One per line. Currently only supports top-level domains. This is overridden by links with the 'require-speedbump' class, see Usage.

### Proceed Button Text

The text for the button that allows a user to proceed.

### Remain Button Text

The text for the button that closes the dialog.

## Usage

After installing the plugin and configuring the settings, add the template hook into your main _layout.html file:

`{% hook 'speedbump' %}`

 The dialog will automatically display for all links, with the exception of the current site URL and any domains in the whitelist.

To enforce the speedbump for a link, add a class of 'require-speedbump' and the speedbump will always display.

The plugin includes a basic CSS file and is fully accessible.