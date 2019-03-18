# Speedbump for Craft CMS 3.x

A a11y compliant plugin for Craft CMS that displays a dialog to users when navigating off-site.

## Installation
1. Move the `speedbump` folder into your `craft/plugins` directory
2. Install the plugin in the Craft Control Panel

### Settings

#### Speedbump Text

The message that's displayed within the dialog.

#### Use Only Class

When enabled, the speedbump will be displayed only on links with the `require-speedbump` class.

#### Whitelist

The domains that are excepted from displaying the dialog. One per line. Currently only supports top-level domains. This is overridden by links with the 'require-speedbump' class, see Usage.

#### Proceed Button Text

The text for the button that allows a user to proceed.

#### Remain Button Text

The text for the button that closes the dialog.

### Usage

After installing the plugin and configuring the settings, add the template hook into your main _layout.html file:

`{% hook 'speedbump' %}`

 The dialog will automatically display for all links, with the exception of the current site URL and any domains in the whitelist.

To enforce the speedbump for a link, add a class of 'require-speedbump' and the speedbump will always display.

The plugin includes a basic CSS file and is fully accessible.