This guide covers the special output styles available in your documentation.  These styles are
all for special call-outs that you can use in your documentation and are meant to help make 
your docs super-awesome
-----BODY-----
If you haven't read the [Getting Started](getting_started.html) guide yet, you should do so now.

# Output Styles

If you've been reading these docs thoroughly, you've no doubt seen that there are some nice
"callout" block styles used throughout.  The good news is that these are also available for
your use in your own docs.  This guide covers those styles and how to use them.

The special styles available, briefly, are:

* Block Quotes
* Notes
* Exclamations
* Info
* Warnings

## Block Quotes

Block quotes aren't really that special, but they do have their own style.  To use them, you can
either use the standard markdown syntax for block quotes, or the html equivalent.

#### Syntax

The syntax for a block quote is:

	>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do 
	>	eiusmod tempor incididunt ut labore et dolore magna aliqua.
	
#### Sample Output

>	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.

## Notes

The notes style is good for calling out important, non-critical information.  I look at it as a way
to draw more attention to something that you'd like your readers to be aware of, that they might potentially
miss if they were skimming your docs.

#### Syntax

To produce a note, you'll need to use the HTML for a block quote, and give it a certain css class:

	<blockquote class="note">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</blockquote>
	
#### Sample Output

<blockquote class="note">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</blockquote>

## Exclamations

These are similar to notes, but have a slightly different icon... an exclamation!

#### Syntax

To produce an exclamation, you'll need to use the HTML for a block quote, and give it a certain css class:

	<blockquote class="ticket">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</blockquote>
	
#### Sample Output

<blockquote class="ticket">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</blockquote>

## Info

Info messages use a blue style, rather than the yellow of the prior two.

#### Syntax

To produce an info block, you'll need to use the HTML for a block quote, and give it a certain css class:

	<blockquote class="info">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</blockquote>
	
#### Sample Output

<blockquote class="info">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</blockquote>

## Warning

Warning messages use a red style, and are very hard to miss in your docs.

#### Syntax

To produce a warning block, you'll need to use the HTML for a block quote, and give it a certain css class:

	<blockquote class="warning">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</blockquote>
	
#### Sample Output

<blockquote class="warning">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</blockquote>