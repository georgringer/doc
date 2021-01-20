# Markdown CheatSheet

Writing Markdown is fairly simple. Checkout this [guide](https://www.markdownguide.org/basic-syntax/)
for the basic syntax including stuff like:

- headings
- paragraphs
- lists
- code
- links
- images

## Docsify helpers

This extension uses [docsifiy](https://docsify.js.org/#/helpers) for converting Markdown to HTML on the fly
and there are some nice helpers included which extend the Markdown ruleset.

### Important content

!> Never save passwords on GitHub

```markdown
!> Never save passwords on GitHub
```

--------

?> Clearing the **cache** can help!

```markdown
?> Clearing the **cache** can help!
```

### Tasks

- [x] Finished task
- [ ] Something todo
- [ ] Something else

```markdown
- [x] Finished task
- [ ] Something todo
- [ ] Something else
```

### Image resizing
The image instruction can receive reseizing information `':size=WIDTHxHEIGHT'`.
![logo](../_img/typo3.png)
![logo](../_img/typo3.png ':size=50x50')
![logo](../_img/typo3.png ':size=100')
![logo](../_img/typo3.png ':size=10%')

```markdown
![logo](../_img/typo3.png ':size=50x50')
![logo](../_img/typo3.png ':size=100')
![logo](../_img/typo3.png ':size=10%')
```

### Using raw HTML

You need to insert a space between the html and markdown content.

<details>
<summary>Self-assessment (Click to expand)</summary>

- Abc
- Abc

</details>


```markdown
<details>
<summary>Self-assessment (Click to expand)</summary>

- Abc
- Abc

</details>
```

!> Be aware that raw HTML does also mean JavaScript which can quickly lead to security issues!!
