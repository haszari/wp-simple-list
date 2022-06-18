## Simple List Add Form

This WordPress plugin adds a block that allows a user to create posts quickly from the front end of the site.

- The user must be logged in and have permissions create posts.
- The user can supply a post title.
- The user can select from site tags using an autocomplete control.

You'll need to add the block to the front end of the site. Recommend adding to a page (not a post).

There's no support for adding body content to the post. This is designed for simple sites containing lists of titles/names with tags to organise and browse. All other editing can be done using regular WordPress UI.

## How to build

Clone this repository.

The source code and build scripts are in `blocks/add-item-form`. Switch to that folder first:

- `cd ./blocks/add-item-form`.

Set up:

- Install node.js.
- `npm install` to install dependencies.

Build, using `@wordpress/scripts`:

- `npm start` to run for development, with live rebuild when you make changes to source.
- *OR*
- `npm run build` to build for production or deployment.
