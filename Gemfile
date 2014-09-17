# Pull gems from RubyGems
source "https://rubygems.org"

# gem "rails"

# Sass, Compass and extensions.
# '~>' Refers to all versions of the given gem on the current full version number. For a specific version of a gem, remove the '~>' or use greater than '>','>='
# Use these sass/compass versions if you don't want sourcemaps (less buggy compiling)
gem "sass", '~> 3.2.19'              # Sass version with source-maps https://github.com/Compass/compass/issues/1108
gem 'compass', '~>0.12.6'            # Framework built on Sass.
# Use these sass/compass versions if you want sourcemaps 
#gem "sass", '~> 3.3'                 # Sass version with source-maps https://github.com/Compass/compass/issues/1108
#gem 'compass', '~>1.0.0.alpha.19'    # Framework built on Sass.
gem 'compass-rgbapng'                # Turns rgba() into .png's for backwards compatibility.
gem 'singularitygs'                  # Alternative to the Susy grid framework.
gem 'breakpoint'                     # Manages CSS media queries.
gem 'compass-css-arrow'              # Easy css3 arrows
#gem 'sassy-buttons'                  # Easy css3 buttons
#gem 'susy'                          # Susy grid framework.
#gem 'toolkit'                       # Compass utility from the fabulous Snugug.
#gem 'oily_png'                      # Faster Compass sprite generation.
#gem 'css_parser'                    # Helps `compass stats` output statistics.

# RDG Drush compiling workflow 
gem 'guard'
gem 'guard-livereload', '~> 2.2.0'
gem 'guard-compass'
gem 'growl'
gem 'terminal-notifier'
gem 'terminal-notifier-guard'

# RDG Bundler, Compass and Gaurd commands
# 'drush PROJECTNAME.local bundle' installs necessary gems on per project basis
# 'drush PROJECTNAME.local compass start' compiles and watches project without success messages.
# 'drush PROJECTNAME.local compass watch' compiles and watches project with success and error messages in terminal. 
# 'drush PROJECTNAME.local compass watch --compass-options="sourcemap"' To add sourcemap to the Compass output (requires #gem "sass", '~> 3.3' --- #gem 'compass', '~>1.0.0.alpha.19')
# Also, you can run these without the RDG aliasing (PROJECTNAME.local) directly inside the drupal project folders 'drush compass...'

# General Bundler commands
# Run 'bundle install' to create Gemfile.lock and download gems to your local machine.
# OR Run 'bundle install --path .bundle' to place the needed gems right inside your project. To achieve this run bundle install with the path option.
# Run 'bundle check' to check dependencies without installing new gems.
# Run `bundle exec compass watch` instead of simply `compass watch` to compile and live reload with project specific gems.
# Run 'bundle exec compass compile --sourcemap' to compile project gems with sourcemaps (requires #gem "sass", '~> 3.3' --- #gem 'compass', '~>1.0.0.alpha.19')
# Run 'bundle exec compass watch --sourcemap' to continuously compile project gems with sourcemaps
