require 'rake'

module DocumentrHelper
  ROOT_DIR        = File.expand_path(File.dirname(__FILE__))
  SRC_DIR         = File.join(ROOT_DIR, 'src')
  DIST_DIR        = File.join(ROOT_DIR, 'dist')
  DOCS_DIR        = File.join(ROOT_DIR, 'docs')
  DOCS_OUTPUT_DIR = File.join(SRC_DIR, 'docs')
  
  def self.package
    puts "\n>>> BUILDING PEAR PACKAGE <<<"
    system "php package_builder.php"
    system "cd #{DIST_DIR} && pear package #{SRC_DIR}/package.xml"
  end
  
  def self.docs
    puts "\n>>> GENERATING DOCUMENTATION <<<"
    system "cd #{DOCS_DIR} && documentr"
  end
end



namespace :build do
  desc "Builds the Pear Package"
  task :package do
    DocumentrHelper.package
  end
  
  desc "Generate Documentation"
  task :docs do
    DocumentrHelper.docs
  end
end

desc "Builds Documentr"
task :build => ['build:package', 'build:docs']

task :default => :build