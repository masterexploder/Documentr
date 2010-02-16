This guide covers installation of Documentr and steps for setting up a documentation project.  After reading this guide, it's 
recommended that you also read the [Writing & Generating Documentation](generating_documentation.html) guide.
-----BODY-----

# Installation

Installing Documentr is easy, since it's all done via PEAR.  Assuming you've got PEAR installed and you've got admin
rights if you need them, all you need to do is run the following from the command line (you may need to sudo these):

	pear channnel-discover pear.gxdlabs.com
	pear install gxdlabs/Documentr
	
That's it, you're ready to go!

# Setting Up A Documentation Project

Setting up a documentation project is also easy.  All you need to do is create a few directories, and a config.yml file.
If you're not familiar with YAML, now would be a good time to [read up on it](http://components.symfony-project.org/yaml/trunk/book/02-YAML) (don't worry, it's super-easy).

## Project Layout

There's really no set way to lay out a documentation project, but here's the directory structure I suggest you get started with:

	/docs
		/config.yml
		/output
		/source
		
Basically, create a directory somewhere in your code base or file system called `docs` and two directories within that 
called `output` and `source`.  Also create a `config.yml` file.  The `source` directory will contain all the markdown files
that the documentation will be generated from, and the `output` directory is where the generated docs will be written.  

<blockquote class="note">Make sure the output directory is writeable by the user you'll be executing Documentr as, otherwise all sorts of nasty error messages await.</blockquote>

Of course, you can set this up however you want, we'll use the config.yml file to tell Documentr where all this stuff is.  However, the rest of this guide assumes the 
structure above

## The Config File

The config file consists of two sections: The first, some basic information about your project, and the second the actual guide hierarchy.  Lets take a look at a sample config.yml file:

	name: "My Cool Project"
	introduction: "A short blurb of text to be displayed on the documentation home page."
	copyright_message: "Copyright &copy; 2010 Your Name"
	template: "default"
	output_dir: "output"
	source_dir: "docs"

	guides:
	    Start Here:
	        Getting Started:
	            source_file: "getting_started.md"
	            description: "Sample documentation generated from an existing markdown file"
	        Sample Guide:
	            source_file: "sample_guide.md"
	            description: "This is a yet-to-be written guide.  It will not be linked to"

	    Works In Progress:
	        Incomplete Guide 1:
	            source_file: "incomplete_guide_1.md"
	            description: "This guide is incomplete"
	            wip: true
	        Incomplete Guide 2:
	            source_file: "incomplete_guide_2.md"
	            description: "This guide is also incomplete"
	            wip: true
	
As I've said, nothing too complicated.  

### Global Config Items

First, let's take a look at the top section and what these items are:

* **name** The name of your project.  This is used for titles throughout the generated docs.
* **introduction** This text is used on the home page of your documentation and can contain whatever you'd like (including HTML).
* **copyright_message** This is the copyright message that will be placed in the footer of all your docs pages.  HTML is OK in this one as well.
* **template** The name of the template to use when generating the docs.
* **output_dir** The directory (relative to the config file) to output the generated docs to.
* **source_dir** The directory (relative to the config file) where all your markdown files are located.

### Guides Config Items

The next section (guides) in the config file defines our documentation hierarchy.  This section defines the grouping of guides on the home page, as well as 
the guide index, and the actual guides that will be included in your documentation.  The basic structure of this section works like this:

	guides:
		Group Name:
			Guide Name:
				source_file: "some markdown file.md"
				description: "Some text that describes this guide."
				wip: true
				
You can have as many groups as you'd like, and as many guides as you would like.  You can even define your whole documentation hierarchy before you've created
any markdown files.  If Documentr can't find the source file for any guide while it's parsing, it simply won't create a link to that guide, but it will still 
show up in your guide index.  

Another thing to note is the "`wip: true`" item.  This item is optional, but if present and set to true, the guide will be marked as a "work in progress" on 
the documentation home page.

If this stuff doesn't quite make sense, take a look at the guides config for this documentation:

	guides:
	    Start Here:
	        Getting Started:
	            source_file: "getting_started.md"
	            description: "An overview of Documentr including installation and setting up a documentation project"
	        Generating Documentation:
	            source_file: "generating_documenatation.md"
	            description: "How to generate documentation using Documentr"    
	    Digging Deeper:
	        Including Images:
	            source_file: "including_images.md"
	            description: "How to include images in your documentation"
	        Special Output Styles:
	            source_file: "output_styles.md"
	            description: "Learn about the special output styles available with the built-in templates for your documenation"
	        Create Your Own Templates:
	            source_file: "create_templates.md"
	            description: "This guide covers how to create your own templates."
	
Now, take a look at the home page, or the Guides Index (links at the top of the page), and it should make a bit more sense where and how these things are used.

# Next Steps

At this point, you should be ready to start creating markdown files for your documentation, and actually generating the docs.  Now would be a good time to 
read the [Writing & Generating Documentation](generating_documentation.html) guide