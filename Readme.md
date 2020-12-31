# TYPO3 Extension `doc`

This extensions provides a new module below *Help* called *Project Documentation* to deliver your documentation to your clients and also for yourself.

It is based on Markdown which makes it easy to write it all down during or after creating custom extensions, content elements, release notes or anything which needs to be documented and should not be forgotten.

The JS library [docsify](https://docsify.js.org/) transforms **markdown files** into beautiful HTML content.

![Demo](Resources/Public/Images/Demo.png)

## Setup the extension

Download the extension. Use one of the following options:

1. *Composer*: `composer req georgringer/doc`
2. *TER*: Download extension from [TER](https://extensions.typo3.org/extension/doc/)
3. *TYPO3 Backend*: Download extension in *Extension Manager*

### Configuration

Switch to **Install Tool/Settings** and customize the global configuration.
As seen in the screenshot below, the following configuration options are available:

* `Documentation Root Path`: Define the path to the Markdown files
* `Dark mode`: Enable the dark mode

![Extension Configuration](Resources/Public/ExampleDocs/_img/ExtensionConfiguration.png)

## Write the documentation

> Without any documentation, this extension is not useful at all :)

Checkout the sample documentation inside `EXT:doc/Resources/Public/ExampleDocs`
and also the **Markdown Cheatsheet** as there are some nice features available.
