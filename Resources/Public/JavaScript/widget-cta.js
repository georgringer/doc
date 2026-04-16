document.addEventListener('DOMContentLoaded', function () {
    setTimeout(() => {
        document.querySelectorAll('.widget-cta[href="open-docs-module"]').forEach(element => {
            element.addEventListener('click', function (event) {
                event.preventDefault();
                var TYPO3 = TYPO3 || top.TYPO3;
                TYPO3.ModuleMenu.App.showModule('help_doc');
            });
        });
    }, 750);
});