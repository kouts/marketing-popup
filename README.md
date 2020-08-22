# marketing-popup

A Vue.js single-page app to create, configure, and display marketing popups.

More specifically the popups that can be created have a display frequency setting (i.e days/weeks/months denoting how often the popup will be displayed) and can include some or all of the following traits:
- Open with a timer
- Open after scrolling x% of the page
- Open with Exit-intent tracking

The marketing popup is implemented as a Vue.js component in a way that multiple instances can be dropped on the same page.

### Tools used
The frontend is created with Vue.js, Vue Router, Vuex, axios, and Bootstrap.

The API is created with Lumen micro-framework (PHP - MySQL).

### Views
**Configuration:**
This is the view that is used to create edit and delete the popups. Up to 3 popups can be created.

**Marketing page:**
This is the sample page that is used to display the popups created in the configuration view.


**Some notes**
- Popups use LocalStorage to store data about how often they can be displayed. After editing a popup this "frequency" setting gets reset.
- Popups can also open "manually" when bound into certain links on the page.

### Live demo
The app gets deployed using GitHub actions and you can [view it here](https://marketing-popup.temp.gr).

## Project setup
### Db
- Create a new Db on your MySQL server.
- Import the .sql file found in the root of this repo into the newly created Db.

### Environment config
The root directory of this repo contains a .env.example file. You should rename the .env.example file to .env and fill in the `APP_URL` and Db connection details.

### Install Composer dependencies
```
composer install
```

### Install npm packages
```
npm install
```

### Start the development server
```
npm run serve
```

### Compile and minify for production
```
npm run build
```