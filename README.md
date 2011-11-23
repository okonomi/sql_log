# SQL Log to file plugin for Cake 2.0

A plugin to write the SQL logs to the error file.

It logs the sql and number of rows affected also.
***WARNING*** if active it swtiches debug on automatically
so don't enable on live server.

In some cases I like to log sql statements but I want the view to render without
debug output or full debugkit slowing things down.

## Instructions
   1. Download the plugin and put it in /app/plugins/sql_log.
   2. Add the plugin to your AppController:
      var $components = array('SqlLog.SqlLog');
   3. Set to either true or a string for the file name
   
      `Configure::write('SqlLog.record', true);`

based on original code by Matt Curry

## Copyright
  Copyright (c) 2008 Matt Curry
  www.PseudoCoder.com
 
  90% of this code is taken from the DebugKit
  http://thechaw.com/debug_kit
 
  @author      Matt Curry <matt@pseudocoder.com>
  @license     MIT