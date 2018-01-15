# Zume Android WP Plugin
This plugin is intended to extend the Wordpress and Zume Project website to be integrated with an Android App.

The Android App repo can be found here: https://github.com/ZumeProject/zume-android-app

## Code Style 
The Zume Project follows the Wordpress coding standards: https://codex.wordpress.org/WordPress_Coding_Standards

## Plugin Integration to the Zume Project 
All supporting code and integration for the Android mobile app is to be included in this Wordpress plugin, so as to keep
the code modular. 

## Authentication
The WP REST API does not have an authentication system natively in place. There are a number of Wordpress plugins that can help 
facilitate the token system needed for mobile integration.

1. Consider the JWT plugin: https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/
1. For local development only, consider: https://github.com/WP-API/Basic-Auth
