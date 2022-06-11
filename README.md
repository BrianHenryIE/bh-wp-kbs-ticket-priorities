[![WordPress tested 6.0](https://img.shields.io/badge/WordPress-v6.0%20tested-0073aa.svg)](https://wordpress.org/plugins/bh-wp-kbs-ticket-priorities) [![PHPCS WPCS](https://img.shields.io/badge/PHPCS-WordPress%20Coding%20Standards-8892BF.svg)](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards) [![PHPUnit ](.github/coverage.svg)](https://brianhenryie.github.io/bh-wp-kbs-ticket-priorities/) [![PHPStan ](https://img.shields.io/badge/PHPStan-Level%208-2a5ea7.svg)](https://github.com/szepeviktor/phpstan-wordpress)

# Ticket Priorities for KB Support

Adds a priority field for [KB Support](https://wordpress.org/plugins/kb-support/), WordPress ticketing system.


* Displays a dropdown on the ticket edit screen to change the priority.

![Create ticket screen](./assets/create-ticket.png "Low/Medium/High Priority options when saving a ticket")
 
* Displays a column in the ticket list showing each ticket's priority.
  
![List table column](./assets/list-table.png "New column at right of table")

* Adds a filter on the ticket list table to show e.g. only high priority tickets.

![List table filter](./assets/filter.png "Filter above table")

`wp post list --post_type=kbs_ticket --ticket_priority=high`
 
* TODO: Tickets not created/saved in the admin UI probably won't filter properly in the list table.
* TODO: Log when the ticket priority changes.

## See:

* [KB Support WordPress plugin on WordPress.org](https://wordpress.org/plugins/kb-support/)
* [KB Support on GitHub](https://github.com/WPChill/kb-support)