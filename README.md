# i18n Manager

## What is i18n Manager?

**i18n Manager** is a web application intended to manage language packs based on structured text files (json, csv...) so it doesn't need a database server like MySQL or PostrgreSql.

## Installation

First, clone repository and install PHP dependencies. Open a terminal and enter:

```
git clone https://github.com/jaceldran/i18n-manager.git
cd i18n-manager
composer install
```
Then rename or copy `.env-sample` to `.env` and configure the url base
and export paths to fit your needs or just leave the defaults.

```ini
[environment]
ENV=develop

[app]
URL_BASE=http://i18n.local

[paths]
EXPORT_JSON={APP_PATH}/export/json
EXPORT_PHP={APP_PATH}/export/php
EXPORT_CSV={APP_PATH}/export/csv
```

Finally, start the PHP Development Server from a terminal pointing to
the URL_BASE set in `.env`:

```
php -S i18n.local:80
```
And then open a browser and access to that address.

Alternatives to PHP development Server:

- Use a plugin like [PHP Server](https://marketplace.visualstudio.com/items?itemName=brapifra.phpserver) (Visual Studio Code) or
[PHP Built-in server](https://www.jetbrains.com/help/phpstorm/php-built-in-web-server.html) (PHP Storm).
- Or, if you already have a local server (Xampp, Laragon...), allocate the
application in a public folder.

Anyway, don't forget to set the proper URL_BASE in `.env` file.

# Sections

## Translations

**Translations** is the main page where translations are managed.
The translations list is grouped into drop-down sections and each translation is
identified by a unique `key` made up of parts separated by periods.
So, for example, you could group all the button texts in the `button`
group and the collection would look something like:

* **button.accept**
* **button.cancel**
* **button.confirm**
* **button.submit**

Or grouping with more levels:

* **commercial.opportunities.open**
* **commercial.opportunities.won**
* **commercial.opportunities.lost**
* **commercial.activities.mail**
* **commercial.activities.phone**
* **commercial.activities.visit**

In either case, the grouping rule takes the last part of the `key` as the main
translation term while the rest is the category to group on. So, the previous
entries would be displayed in this way:

* [-] **<u>button</u>**
	* cancel
	* confirm
	* submit
* [-] **<u>commercial.activities</u>**
	* mail
	* phone
	* visit
* [-] **<u>commercial.opportunities</u>**
	* lost
	* open
	* won

### Top bar actions

#### Open - Close
Fold/unfold all translations groups.

#### Import
Uploads a CSV file of translations. Must contains a column named `key` and one
column named per language ISO code.

#### Export
Builds these files:

* One file named ```all.php```
* One file named ```all.json```
* One file named ```all.csv```
* As many JSON files as available languages, one for each language.
* As many PHP files as available languages, one for each language.

So, if the application is installed on the same server as the *frontend* or
the *backend*, you can configure the export paths to the folders that the
applications are using for their multilanguage system.

#### Download
Downloads a zip file containing the files described above.

#### New
Opens a form to create a new term. By default in the *app* group.

### Inline actions

#### Create
Each group can also be collapsed/unfolded separately by clicking on the name.
On the right side there is a button with the + sign that opens a form to create
a new entry that puts the initial value of the *key* indicating the current
group, ready to introduce the new term. But you can also enter new *keys*
to create new groups.

#### Edit
Translations can be updated in 2 ways:

##### Inline (individual)
Directly enter the value of each translation in the editable inputs. This mode
depends on the languages enabled as visible and editable in
the *Langs* section.

##### On form or full
Click a *key* to open a form and edit in full mode.

#### Delete
Click on the trash icon at the end of the row,

## Langs

The **Langs** section manages the list of languages of the application.
From here you can add, enable/disable for editing, and show/hide
in the **Translations** section view. You can also drag and reorder
by rows.

### Top bar actions

#### New
Enter the ISO code of a language. Once the form is submitted, the language
list will be reloaded with the new addition.

### Inline actions

#### Visible/Editable toggle switchs
Each language has 2 toggle switches to toggle its visibility and editing
status on or off.

If not enabled as visible, it will not be on the translations page.

If not enabled as editable, it will be on the translations page but not
enabled for inline edition.

#### Delete button
Deleting the language removes it from the list of managed languages but does
not delete any translations that may have been previously saved. That is, if a
language that already had the translations completed is accidentally deleted,
the translations can be recovered by adding the language back to the
language list.

## Configuration

### Paths

Displays the export paths of the translation files.

In case this manager is on the same server, these paths should point to the
folders consumed by the *frontend* or *backend* solutions for the
multi-language management, .

### Env

Environment information.

## Dependencies

- [Flight - An extensible microframework in PHP](https://flightphp.com/)
- [Tailwind CSS - Build modern websites](https://tailwindcss.com/)
- [BladeOne - Standalone version of Blade Template Engine](https://github.com/EFTEC/BladeOne)
- [Parsedown - Better Markdown Parser in PHP](https://github.com/erusev/parsedown)
- [Free Country Flags in SVG - Flag icons](https://flagicons.lipis.dev/)
- [Ultralight icons created by Freepik - Flaticon](https://www.flaticon.com/free-icons/ultralight)
