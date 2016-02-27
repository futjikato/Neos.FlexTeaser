# Flexibel Teaser

This module comes with a teaser module that is
essentially a frame for you to create teasers
with.

## Installation

`composer require futjikato/flexteaser`

## Create teaser templates

This module is a flexible frame but does not provide
teaser layouts as I think those are specific to your
page.
To create teaser renderer create a content module
and add `'Futjikato.FlexTeaser:RendererMixin'` as
a mixin. Now the module should show up in the

The page selected by the strategy is provided as
node so the TypoScript for your teaser layouts can
be straight forward.
See the code for the current fallback teaser below:

```
prototype(Futjikato.FlexTeaser:FallbackTeaser) < prototype(TYPO3.Neos:Content) {
    templatePath = 'resource://Futjikato.FlexTeaser/Private/Templates/FallbackTeaser.html'
    pageTitle = ${q(node).property('title')}
}
```

The template is just as simple and easy:

```
<p>Select a teaser renderer in the inspector.</p>
<p>Selected page is: {pageTitle}</p>
```

## Create a custom strategy

This module comes build in with two strategies.
"Selected page" and "Newest child" can be considered
demos on how you can create your own strategy.