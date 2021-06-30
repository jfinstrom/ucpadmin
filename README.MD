# WHAT?

The idea here is to create a template user in UCP that can be cloned to other users.

-   This is a cli app that takes all the dashboards from a given username and writes them to another user.
-   This is a destructive action meaning it nukes existing dashboards
-   This does not clone permissions so the permissions need to be set in usermanager by user or group independently of this.

# Why?

There is a long standing feature request for templates in UCP. It doesn't appear they will ever happen. So this is a quick cli tool that gets the feature in place

# Install

```
git clone https://github.com/jfinstrom/ucpadmin.git
cd ucpadmin
composer install
chmod +x ucpadmin
```

# Usage

```
./ucpadmin templateuser johndoe janedoe
```

The first argument is the source username. Additional arguments will be taken as a list of destinations

## License

GNU Affero General Public License v3.0

## Boilerplate disclaimers and spam

-   This is a personal project and is not supported nor endorsed by current, former or future employers.
-   This is not really supported by anyone. This was written for my use ans shared for community benefit.
-   Trademarks used under fair use and are not meant to imply permission of use or endorsement.
-   I am not "for hire" if you need consulting or development done consider going through [my employer](https://www.clearlyip.com/consulting/).
-   My side projects are made possible because my employer takes care of my financial needs. If you wish to show financial support please feel free to buy something from [them](https://www.clearlyip.com/products/).
