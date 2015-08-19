# damn-website
DAMn° Magazine website


## Install (Mac)
The days of simple html pages are long behind us, sir. For most of our front-end apps, we distribute static packages, with dependency configuration and branched repo versioning. If this sounds scary, don't worry, its like rainbows and unicorns.

### Prerequisites
To install the required components for managing and compiling the DAMn website, 
we'll need following tools in our toolbelt: Composer, Git, npm, Bower and Gulp.

[More info](http://blog.cloudoki.com/set-up-your-local-battleground/)

##### Get HomeBrew
If you haven't done so, install Brew right away.
```ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"```

##### Composer
Start with installing [Composer](https://getcomposer.org/), the dependency manager.

```
brew tap josegonzalez/homebrew-php
brew install josegonzalez/php/composer
```

##### Download Github
If you don't actively use one of the smaller versioning services, you'll probably end up with Github. Good choice too.
Github has an awesome software client for managing your repositories locally.

**[Download Github for Mac](https://mac.github.com/)**

##### Install Node.js
[Nodejs](http://nodejs.org/) is basicly backend javascript. It’s lightweight and perfect for local builds of compile/distribution dependent projects. Since we’re taking this seriously, that’s just what we’ll do. Add Node.js and npm with brew:

`brew install node`

##### Instal Gulp
[Gulp](http://gulpjs.com/) is a Task Runners, which will monitor, compress and compile the project. Gulp a nimble sytar, which makes you feel like you’re doing it for real. Install it with npm:

`npm install -g gulp`

##### Install Bower
[Bower](http://bower.io/) is the package manager we’ll be using in many projects. Additionally, most of the front-end frameworks come with a bower configuration.

`npm install -g bower`

####Install Sass
Sass is a css extension language. It lets you nest, fragment, re-use, import and compile css code and files. While we're not using it in every project, you'll smell cupcakes and blow glitter out your working station when you do the first time.

`sudo gem install sass`


### The Project
First, clone the damn-website project to your regular project folders location

```
git clone https://github.com/Cloudoki/damn-website.git
```

Now we willll have to install the roots/bedrock required components.

```
cd /local/path/to/damn-website
composer install
```
Copy the dotenv file and set up your local environment parameters.

```
cp .env.example .env
nano .env
```

### The Theme
The theme uses roots/sage as theme stack, install the required components

```
cd damn-sage
npm install
bower install
```
Let's create the theme `dist` folder and add it's path for compiling in the theme manifest.

```
mkdir ../web/app/themes/damn-sage
cp assets/manifest.example.json assets/manifest.json
nano assets/manifest.json
```

## Usage
For more info on using roots/bedrock, head to [roots.io/bedrock](https://roots.io/bedrock/).

The theme is managed though Gulp. Some basic commands:

```
gulp #Compile and optimize the files in your assets directory
gulp watch #Compile assets when file changes are made
gulp --production #Compile assets for production
```

For more info on using roots/sage, head to [roots.io/sage docs](https://roots.io/sage/docs/theme-development/).