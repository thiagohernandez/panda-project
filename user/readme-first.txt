Important!
----------

This is a modified version of PHPixie 2.0 created by FTB.

It has _many_ modifications to the core PHPixie files
and a lot of reorganisation of files/folders to make a
more logical MVC structure (make it easy to find things).



The main modifications are:

 
/* ---------------------------------------------------------------------------
 * New classloader, PHPixie modules included by default
 * --------------------------------------------------------------------------- */

I nuked the composer classloader and replaced it with something
much smaller/simpler/faster.

If you're a big composer fan? You'll hate me, but ... you're not
my target demographic and PHPixie2 probably wasn't for you anyway
(try PHPixie 3.0, it's full of Composer goodness...)

I also put all the most important PHPixie modules into the 'phpixie'
folder (in folder 'modules') instead of having to download them via
Composer.


/* ---------------------------------------------------------------------------
 * Ability to install PHPixie apps in parallel with other PHP applications
 * on the same server (and run both apps simultaneously!)
 * --------------------------------------------------------------------------- */

Place your PHPixie app in a subfolder (eg. "forest") on your server.

Next, You need to modify your server's .htaccess, add the following lines:

RewriteRule ^forest$ /forest/web/index.php [L,QSA]
RewriteRule ^forest/(.*) /forest/web/$1 [L,QSA]

Now any URL that begins with "/forest" will redirect to your app's 'web'
folder.

eg. if you access "/forest/dwellers" on your server the "Dwellers"
controller in your app will be used.

Inside your application you'll have lots of hyperlinks and references
to files. You now need to add '/forest' to the start of *all* of them.
(this will be a lot of work for an existing application...!)

Or... you can use a more intelligent ViewHelper.php which knows the
prefix and adds it to your links automatically.

In the skeleton app you'll find a new ViewHelper.php with several
functions for inserting the following types of files into your views:

* css
* script
* img
* link

nb. The subfolder name is defined in your app's main Pixie.php file.


The functions
-------------

The first one, "css", outputs the HTML code to include a css file.
eg. In your view template you can write:

<?= $_css('styles.css') ?>

And it will output:

<link rel="stylesheet" href="/web/css/style.css">

If you've set "$basepath" to (eg.) 'forest' in your main Pixie file it
will output this instead:

<link rel="stylesheet" href="/forest/web/css/style.css">



"script" does the same thing for JavaScript files. If you write this in
your view template:

<?= $_script('myscript.js') ?>

It will output the following:

<script src="/web/js/myscript.js"></script>



"img" is for image files. This code:

<img src="<?= $_img('trixie.png') ?>">

Will output:

<img src="/web/img/trixie.png">


"link" is for hyperlinks. If you type this when "$basepath" is
set to 'forest':

<a href="<?= $_link('/fairies/spells') ?>">

You'll get:

<a href="/forest/fairies/spells">


nb. Link names should start with a '/' (unlike the previous functions)


Modified files:
./phpixie/core/Pixie.php

/* ---------------------------------------------------------------------------
 * Access phpixie modules directly from controllers
 * --------------------------------------------------------------------------- */

I got tired of typing "$this->pixie->xxx" in Controllers so I made the
controller's "__get()" function pass the parameter to the pixie object
if it fails to find a plugin (plugins are checked first).
 
Result: Instead of typing "$this->pixie->orm->..." in a Controller you
can now type "$this->orm->..." (ie. the 'pixie' part isn't necessary).

(nb. You can still type 'pixie' if you want to...)


/* ---------------------------------------------------------------------------
 * Controller plugins
 * --------------------------------------------------------------------------- */

I made the Controller classes extensible using a mechanism similar to the
way PHPixie loads its modules. See the file './phpixie/plugins/readme.txt'
for more info.

 
/* ---------------------------------------------------------------------------
 * Default initialisation of columns in ORM objects
 * --------------------------------------------------------------------------- */

PHPixie didn't initialize the columns of new ORM objects,
this can lead to problems as discussed here:
 
https://phpixie.com/forum/discussion/372/behavior-of-unset-orm-fields
 
PHPixie v2.x has an (undocumented!) function "init_columns()"
to initialize all fields. It works, but you have to remember
to call it. This is annoying.


I modified ORM\Model,php to call "load_columns()" automatically
whenever you try to access an undefined field in an ORM object.

Now you can do:

$new_fairy = $pixie->orm->get('fairy');

and simply access the columns in the object as normal.

Any column that that you know exists in the database
will be valid.


Modified files:
./phpixie/core/ORM/Model.php



/* ---------------------------------------------------------------------------
 * More complete support for SQLITE databases
 * --------------------------------------------------------------------------- */

PHPixie had some support for SQLITE databases but some things
didn't work (eg.) the database migration functions.


Modified files:
./phpixie/core/Migrate/Driver/PDO.php


/* ---------------------------------------------------------------------------
 * Database migrations
 * --------------------------------------------------------------------------- */

I modified the database migrator to allow "$migrator->migrate_to(null)"
(ie. remove all migrations).

I tweaked the data types a bit. A column type of "timestamp" now
works as you'd expect it to.


I also modified it to allow you to insert data into new tables during
migrations. This makes creating tables like user "roles" very easy.

eg. You might define a migration "0_users_and_roles.php" like this:

<?php
return array(

  // A table for users
  'users' => array(
    'id'          => array('type'=>'id'),
    'role_id'     => array('type'=>'int',     'default' => 1   ),
    'identifier'  => array('type'=>'varchar', 'size'    => 128 ),
    'password'    => array('type'=>'varchar', 'size'    => 128 )
  ),

  // A table for user roles
  'roles' => array(
    'id'   =>  array('type'=>'int'),
    'name' => array('type'=>'varchar', 'size'=>32 )

		// Add predefined roles to the 'roles' table
		'_insert' => array(
				// Your rows of data...
				array('id' => 1, 'name' => 'user'),
				array('id' => 2, 'name' => 'admin')
			)
		)
  ),
  
);

This will add two roles ('user' and 'admin') into the table 'roles'
when you perform the migration.

The new migrator wraps each _insert_into inside a transaction.
This means you can import massive amounts of data without
getting PHP timeouts (I was having some trouble with a
really big database timing out after two minutes, after
the hack the same transaction ran in under two seconds).


Modified files:
./phpixie/core/Migrate/Migrator.php
./phpixie/core/Migrate/Driver/PDO.php


/* ---------------------------------------------------------------------------
 * Logging of SQL transactions
 * --------------------------------------------------------------------------- */

I added a new function "sql()" to the "debug" to log sql transactions.
This lets you see all the database accesses and is a big help
in understanding and optimising applications.

You can display the new SQL log in the same way as the standard debug log:

<div id="logs">
    <?php foreach ($pixie->debug->sql_logged as $log): ?>
        <pre><?php var_export($log);?></pre>
    <?php endforeach;?>
</div>

I also added a new function 'format()' to debug to make the log
output much prettier (no ugly quotes around everything and
it uses JSON_PRETTY_PRINT for the arrays...)

Use it like this:

<div id="logs">
    <?php foreach ($pixie->debug->sql_logged as $log): ?>
        <pre><?= $pixie->debug->format($log) ?></pre>
    <?php endforeach;?>
</div>


Modified files:
./phpixie/core/Debug.php
./phpixie/core/DB/PDO/Connection.php

	
/* ---------------------------------------------------------------------------
 * Insert template elements into a view, with local parameters.
 * --------------------------------------------------------------------------- */

I modified "View.php" to let you insert 'elements' into your views.
An 'element' is a template file with with local variables.
 
eg. Do this inside a view file:
 
<?php $this->insert('elements\fairy.php', array( 'name'=>'Trixie', 'tree'=>'Oak') ); ?>
<?php $this->insert('elements\fairy.php', array( 'name'=>'Tinkerbell', 'tree'=>'Beech') ); ?>
 
This will render the file "elements\fairy.php" twice.

The first time it will be rendered with $name and $tree
set to 'Trixie' and 'Oak'.

The second time it will be rendered with $name and $tree
set to 'Tinkerbell' and 'Beech'


Modified files:
./phpixie/core/View.php




/* ---------------------------------------------------------------------------
 * Get extended database table info
 * --------------------------------------------------------------------------- */

There's already a function "columns()" in Model which returns the column
names of a database object but I needed more info (so I could set the
'maxlength' field in HTML forms...)

I added a new function 'extended_columns()' which returns an array of
items containing column name, column type, number of chars, default value
and 'notnull'

eg.
$obj = $pixie->orm->get('object');
$columns = $obj->extended_columns();

foreach ($columns as $c) {
  echo $c['name'];
  echo $c['type'];
  echo $c['size'];
	...etc.
}

Modified files:
./phpixie/core/Migrate/Driver/PDO/Connection.php



