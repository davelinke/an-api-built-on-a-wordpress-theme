# An api built on a WordPress theme

This is a wordpress theme that outputs json data instead of HTML. If you ask yourself why? just think about throwing in a blender the permalink capabilities of WordPress, plus the caching plugins available plus a JSON/JSONP output and you'll have your answer

## Installation

- Upload to your wp-content/themes folder 
- Activate at the WordPress admin dashboard of your site

## Usage

Just follow the permalink structure you have chosen for your wordpress site in order to get the json data from the posts.

The json structure has 4 keys:

- __header__: returns the information about your wp site.
- __wp_query__: returns the information about the query you sent to WordPress through the permalink
- __categories__: and array contaiing all the categories in your wp site with properties
- __posts__: the posts loop specific to your permalink query.

[Default example](http://elsite.de/wpjson/)

```
// URL: yourWPsite.com/

// OUTPUT:

{
  header:{...},
  wp_query:{...},
  categories:[...],
  posts:[...]
}
```

### Special URL parameters

When getting the data from a page/permalink you can use the following URL parameters for special funcitonality

__callback__: (string) it wraps the json output in a function named after the value of the parameter to obtain a JSONP output.

[JSONP callback example](http://elsite.de/wpjson?callback=callbackValue)

```
// URL: yoursite.com/some-post-url?callback=callbackValue

// OUTPUT:

callbackValue({
  header:{...},
  wp_query:{...},
  categories:[...],
  posts:[...]
});
```

__header__: (boolean) defines if the output should contain the blog header (defaults to true, possible values: true, false).

__categories__: (boolean) defines if the output should contain the categories array, (defaults to true, possible values: true, false).

__query__: (boolean) defines if the output should contain the query object (defaults to true, possible values: true, false).
