# Using this extension

Get started documenting your custom extension. Write directly in your IDE as you build. 

## Write the documentation

?> Without any documentation, this extension is not useful at all :)

Describe what your extension does, how to use it and how to maintain it. You could include descriptions of 
content elements, release notes, instructions for raising issues or anything else that needs to be documented. 
Once you have some content, create structure by adding links to the sidebar navigation.

Check out the sample documentation included in this extension which you can use as a guide `EXT:doc/Resources/Private/ExampleDocs`.
See also the [Markdown Cheatsheet](Setup/Markdown.md) as there are some nice features available.

When you create your own documentation make sure to put the folder with your markdown files in `Resources/Private`. Otherwise your markdown files may be publicly accessible.

The following 3 special files are important:

- `Home.md`: This file is used as homepage.
- `_sidebar.md`: Sidebar on the left. Put all the important links here.
- `_navbar.md`: Navigation on the top right.


## Setup the extension

Download the extension. Use one of the following options:

1. *Composer*: `composer req georgringer/doc`
2. *TER*: Download extension from [TER](https://extensions.typo3.org/extension/doc/)
3. *TYPO3 Backend*: Download extension in *Extension Manager*

### Configuration

Switch to **Install Tool/Settings** and customize the global configuration.
As seen in the screenshot below, the following configuration options are available:

* `Documentation Root Path`: Define the path to the Markdown files
* `Documentation Name`: Documentation name as it appears in the sidebar
* `Dark mode`: Enable the dark mode

![Extension Configuration](../_img/ExtensionConfiguration.png ':size=50%')
