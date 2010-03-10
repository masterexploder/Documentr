This guide covers including images in your documentation.  Documentr can automatically copy images included with 
your documentation source code files when it compiles your documentation.
-----BODY-----
If you haven't read the [Getting Started](getting_started.html) guide yet, you should do so now.

# Including Images

Including images is also, like all things with Documentr, designed to be as painless as possible.  Essentially, you 
need only include an images directory with your source and it will be included with your parsed output.

## Creating the Images Directory

There's really nothing you need to do here, other than create a folder called `images` that sits alongside your
documentation source files (the markdown files).  Using the sample included with the source code as an example, 
the docs directory currently looks like:

	/
		config.yml
		/docs
			getting_started.md
		/output
		
If you wanted to include images, just create a new directory...

	/
		config.yml
		/docs
			/images
			getting_started.md
		/output
		
That's it!

## Including Images in Your Documentation

Once you've got the images directory created, simply drop whatever images you'd like in there.  After that, 
you need only refer to them using standard markdown syntax.  For example, the following code:

	!["New Pet" From XKCD - http://xkcd.com/413/](images/new_pet.png)
	
Gives you the following:

!["New Pet" From XKCD - http://xkcd.com/413/](images/new_pet.png)

*Note that the above image is borrowed from [XKCD](http://xkcd.com/413/)*

For more info on the markdown syntax for images, visit [http://daringfireball.net/projects/markdown/syntax#img](http://daringfireball.net/projects/markdown/syntax#img)