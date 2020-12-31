# Using this extension

Using this extension is fairly easy.

## Write the documentation

?> Without any documentation, this extension is not useful at all :)

Checkout the sample documentation inside `EXT:doc/Resources/Public/ExampleDocs`
and also the [Markdown Cheatsheet](Setup/Markdown.md) as there are some nice features available.

The following 3 special files are important:

- `Home.md`: This file is uses as homepage.
- `_sidebar.md`: Sidebar on the left. Put all the important links here
- `_navbar.md`: Navigation on the top right


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

![Extension Configuration](../_img/ExtensionConfiguration.png ':size=50%')
