add-to-your-favourites-posts
============================

Wordpress plugin to add favourites posts functions. as usual not find an existing plugin meet my need at 100% so implementing my own.


==Steps to complete version 1.0==
- implement atyfp_link()
    - implement ajax atyfp-add
    - implement ajax atyfp-remove
    - implement js to manage ajax reponse above

- add format parameter to atyfp_link()
- implement ajax atyfp_add_favourite()



==Working hard :) ==
29/10/2014
- implement atyfp_link()
    - enqueue atyfp.js for public side
    - added skeleton ajax atyfp-add
    - added skeleton ajax atyfp-remove

24/10/2014
- update main wp_query to retrieve the data associated to each posts and make them available in post data as
    $post[favourites_counter] => 0
    $post[myfavourite] => 0
- implement rendering link add/remove favourite considering options plugin: image, counter

21/10/2014
- create DB schema
- manage DB creation and (updates with plugin?)
- added function atyfp_link() now it has to be implemented

17/10/2014
- create options page
    - enable only registered users
    - mode (counter-single)
    - image(star-heart)


==Steps to complete version 1.1==
- custom image

