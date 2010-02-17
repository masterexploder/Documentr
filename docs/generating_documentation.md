This guide covers writing and generating documentation with Documentr.  After reading this guide, you should be able to 
successfully author and generate your documentation.
-----BODY-----

If you haven't read the [Getting Started](getting_started.html) guide yet, you should do so now.

# Writing Documentation

Writing docs is a royal pain, but it doesn't have to be... that's why I wrote this library in the first place, and, hopefully, 
why you're reading this.  I figured it would be much easier to write documentation in an easy, widely used format and leave the
formatting to something else.

The easy authoring format I chose was Markdown.  It was created by [John Gruber](http://daringfireball.net), and has become more
and more popular, especially in the Ruby and GitHub community.  From the [project site](http://daringfireball.net/projects/markdown/):

<blockquote>Markdown is a text-to-HTML conversion tool for web writers. Markdown allows you to write using an easy-to-read, easy-to-write plain text format, then convert it to structurally valid XHTML (or HTML).</blockquote>

I'll leave it up to you to learn the syntax if you aren't familiar with it already, the reference is located here: [http://daringfireball.net/projects/markdown/syntax](http://daringfireball.net/projects/markdown/syntax)

## Documentr Markdown Files

Writing your documentation for Documentr is as simple as creating markdown files.  There's only one special bit of syntax within these files, and it's completely optional (but shouldn't be
skipped, as your documentation won't be as sexy).

Basically, a markdown file for a guide consists of two parts: the header, and the body.  The header is the text shown directly under the guide title and is a great way to provide an overview of
the guide itself. The rest of your markdown file is the actual body of the guide.

So, what does your markdown file need to look like to accomplish all this?  Glad you asked:

	Put whatever introduction text you want here.  
	Can be as long or short as you'd like
	
	-----BODY-----
	
	Put your body here.  Everything below the above 
	delimeter will be the body of your guide.
	
That's it.

# Generating Documentation

Generating your docs is probably the easiest thing to do with Documentr (which is the point, right?).  Assuming you've got everything set up right in your
config.yml file, you need only navigate to the directory the config.yml file is located in in a terminal, and run:

	documentr
	
Right now, if there are any issues, you'll get nasty error messages from PHP, but that's likely to change down the road as I put more effort into 
robustness.  However, if everything runs without error, you'll see output similar to:
	
	>>> Creating Documentation For Documentr <<<

	Clearing output directory...	done
	Building guide pages...
	 [build] Getting Started...	done
	 [build] Writing & Generating Documentation...	done
	 [skip] Including Images 
	 [skip] Special Output Styles 
	 [skip] Create Your Own Templates 
	Building home page...	done

	----------------------------
	Docs generated in 0.07114 seconds.
	
At this point, your docs are built inside the output directory and you can open them in your browser of choice, publish them to the web, or whatever it is
you want to do with them.