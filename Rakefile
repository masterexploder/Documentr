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
  
  def self.tarball
    puts "\n>>> GENERATING STANDALONE TARBALL <<<"
    
    `mkdir -p #{ROOT_DIR}/build`
    `rm -rf #{ROOT_DIR}/buid/*`
    `cp -rf #{SRC_DIR} #{ROOT_DIR}/build`
    `rm -f #{ROOT_DIR}/build/src/package.xml`
    `cp -rf #{ROOT_DIR}/sample #{ROOT_DIR}/build`
    `rm -f #{ROOT_DIR}/build/sample/output/`
    system("export COPYFILE_DISABLE=true && cd #{ROOT_DIR}/build && tar -zcvf Documentr.tar.gz .")
    `cp #{ROOT_DIR}/build/Documentr.tar.gz #{DIST_DIR}`
    `rm -rf #{ROOT_DIR}/build`
  end
end



namespace :build do
  desc "Builds the Pear Package"
  task :package do
    DocumentrHelper.package
  end
  
  desc "Builds Standalone Tarball"
  task :tarball do
    DocumentrHelper.tarball
  end
  
  desc "Generate Documentation"
  task :docs do
    DocumentrHelper.docs
  end
end

desc "Builds Documentr"
task :build => ['build:package', 'build:docs']

task :default => :build