=== ReverbNation Widgets ===

Contributors: ReverbNationDev
Donate link: http://www.reverbnation.com/
Tags: music,band,reverbnation,tunepak,widget,flash,player,venues,fans
Requires at least: 2.5
Tested up to: 2.9.2
Stable tag: 1.0

This plugin lets you use music players, video players, tunewidgets,
email collectors and other ReverbNation widgets on your wordpress
blog.

== Description ==

This wordpress plugin allows the display of music players, video
players, email collectors, show schedules, and all the ReverbNation
widgets on your blog's posts, pages or sidebars, simply and
efficiently, by the use of the `[reverbnation]` shortcode.

ReverbNation would like to extend special thanks to Philippe Hilger
(http://www.peergum.com) for contributing an initial version of this
plugin.

== Syntax and currently supported options ==

Simply use the `[reverbnation widget=... artist_id=...]` shortcode
where you want the widget to display.  You must at least include a
"widget" option and one of either an artist_id, label_id or venue_id
option, depending on the widget you're trying to display.

The next sections list the available values for the `widget` option,
along with the options each widget supports.

= Players =

* `player`

  A player with all of an artist's songs, or songs by all the artists on a label.

  Requires: `artist_id=<number>` or `label_id=<number>`

  Optional:
  * `bgcolor=<HTML color>` Do not include the "#". Defaults to `EEEEEE`
  * `fontcolor=<HTML color>` Do not include the "#". Defaults to `000000`
  * `shuffle=<true or false>` Defaults to `false`.
  * `autoplay=<true or false>` Defaults to `false`.

  Size: 434x228

  Example:
  > `[reverbnation widget=player artist_id=149 bgcolor=A53000 fontcolor=FFA017 shuffle=true autoplay=true]`

* `mini_player`

  A smaller version of the player.

  Requires: `artist_id` or `label_id`

  Optional: `bgcolor`, `fontcolor`, `shuffle`, `autoplay`

  Size: 262x83

  Example:
  > `[reverbnation widget=mini_player artist_id=1115 bgcolor=A53000 fontcolor=FFA017 shuffle=true autoplay=true]`

* `blog_player`

  A taller, narrower version of the player.  A better fit for blog sidebars.

  Requires: `artist_id` or `label_id`

  Optional: `bgcolor`, `fontcolor`, `shuffle`, `autoplay`

  Size: 180x300

  Example:
  > `[reverbnation widget=blog_player artist_id=69490 bgcolor=FF22EE fontcolor=DEDBEF shuffle=false autoplay=false]`

* `micro_player`

  A smaller, squarer version of the player.

  Requires: `artist_id` or `label_id`

  Optional: `bgcolor`, `fontcolor`, `shuffle`, `autoplay`

  Size: 160x125

  Example:
  > `[reverbnation widget=micro_player label_id=1 bgcolor=DEADBE fontcolor=ADBEEF shuffle=true autoplay=false]`

* `pro_player`

  A more customizable version of the player, only for artists.

  Requires: `artist_id`

  Optional: `bgcolor`, `autoplay`, `shuffle`,
  * `bordercolor=<HTML color>` Do not include the "#". Defaults to 333333.  Not used by all skins.
  * `skin_id=<One of PWAS100N, where N goes from 1 to 7>`
      * `PWAS1001` &mdash; Tiny Spaces
      * `PWAS1002` &mdash; Standard Strong
      * `PWAS1003` &mdash; Reverb Classic
      * `PWAS1004` &mdash; Electro Green
      * `PWAS1005` &mdash; Sketched
      * `PWAS1006` &mdash; Big Button
      * `PWAS1007` &mdash; Big Button Light
  * `width=<number>` Defaults to 262.
  * `height=<number>` Defaults to 200

   Size: varies

   Example:
   > `[reverbnation widget=pro_player artist_id=48415 bordercolor=888888 width=800 height=600 skin_id=PWAS1005 autoplay=true shuffle=true]`
     
* `tunewidget`

  All an artist (or label)'s content contained in one flashy widget.

  Requires: `artist_id` or `label_id`

  Optional: `shuffle`, `autoplay`,
  * `blogbuzz=<blog or buzz>` What gets displayed in the blog / buzz tab of the TuneWidget.  Defaults to buzz.

  Size: 434x415

  Example:
  > `[reverbnation widget=tunewidget artist_id=2105 shuffle=false autoplay=true blogbuzz=blog]`

= Video Players =

* `video_gallery`

  All of an artist (or label)'s songs that include videos in one widget.

  Requires: `artist_id` or `label_id`

  Optional: `bgcolor`, `fontcolor`, `autoplay`

  Size: 332x374

  Example:
  > `[reverbnation widget=video_gallery label_id=1314 bgcolor=FFA017 autoplay=true]`

* `pro_video_player`

  A more customizable version of the video gallery, only for artists.

  Requires: `artist_id`

  Optional: `bgcolor`, bordercolor, `autoplay`, `shuffle`
  * `skin_id=<One of PWVS200N, where N goes from 1 to 7>`
      * `PWVS2001` &mdash; Tiny Spaces
      * `PWVS2002` &mdash; Standard Strong
      * `PWVS2003` &mdash; Reverb Classic
      * `PWVS2004` &mdash; Electro Green
      * `PWVS2005` &mdash; Sketched
      * `PWVS2006` &mdash; Big Button
      * `PWVS2007` &mdash; Big Button Light
  * `width=<number>` Defaults to 262.
  * `height=<number>` Defaults to 200.

  Size: varies

  Example:
  > `[reverbnation widget=pro_video_player artist_id=149 width=180 height=300 skin_id=PWVS2003]`

= Show Lists =

* `artist_shows`

  A list of upcoming shows shows by an artist, or else upcoming shows
  by artists on a label.

  Requires: `artist_id` or `label_id`

  Optional: `bgcolor`, `fontcolor`
  * `view=<list, plain, or smart>` Defaults to list.
      * `plain` &mdash; A full listing of each show.
      * `list` &mdash; A brief listing of each show, and the show can be expanded by clicking on it.
      * `smart` &mdash; If there's more than 3 shows, use list, otherwise use plain.

  Size: 434x247

  Example:
  > `[reverbnation widget=artist_shows artist_id=3193 view=smart]`

* `artist_shows_map`

  A list of upcoming shows shows by an artist.  Also includes an
  Indiana Jones-style map of where the shows are located.

  Requires: `artist_id`

  Optional: `bgcolor`, `fontcolor`, `view`

  Size: 434x538

  Example:
  > `[reverbnation widget=artist_shows_map artist_id=149 view=smart]`

* `blog_shows`

  A taller, narrower version of the shows list.  Idea for blog
  sidebars.

  Requires: `artist_id` or `label_id`

  Optional: `bgcolor`, `fontcolor`, `view`

  Size: 180x300

  Example:
  > `[reverbnation widget=blog_shows label_id=1314 bgcolor=FFA017]`

* `pro_schedule`

  A very customizable version of the upcoming shows widget, only for artists.

  Requires: artist_id

  Optional: `bgcolor`, `bordercolor`, `fontcolor`
  * `skin_id=<One of PWSS300N, where N goes from 1 to 7>`
      * `PWSS3001` &mdash; Tiny Spaces
      * `PWSS3002` &mdash; Standard Strong
      * `PWSS3003` &mdash; Reverb Classic
      * `PWSS3004` &mdash; Electro Green
      * `PWSS3005` &mdash; Sketched
      * `PWSS3006` &mdash; Big Button
      * `PWSS3007` &mdash; Big Button Light
  * `width=<number>` Defaults to 262.
  * `height=<number>` Defaults to 200.

  Size: varies

  Example:
  > `[reverbnation widget=pro_schedule artist_id=2105 bordercolor=FFFFFF]`
   
* `venue_shows`

  A list of upcoming shows at a venue, or a taller list of upcoming
  shows by artists on a label.

  Requires: `label_id` or `venue_id`

  Optional: `bgcolor`, `fontcolor`

  Size: 434x600

  Example:
  > `[reverbnation widget=venue_schedule venue_id=40146]`

= Mailing List Collectors =

* `fan_collector`

  A form allowing people to add their email address to the artist,
  label, or venue's mailing list.

  Requires: `artist_id` or `label_id` or `venue_id`

  Optional: `bgcolor`, `fontcolor`
  * street_team=<true or false> Shows the "Join the street team" checkbox. Defaults to true

  Size: 434x100

  Example:
  > `[reverbnation widget=fan_collector label_id=1 street_team=false]`

* `blog_fan_collector`

  A square "join the mailing list" widget.

  Requires: `artist_id` or `label_id` or `venue_id`

  Optional: `bgcolor`, `fontcolor`

  Size: 180x180

  Example:
  > `[reverbnation widget=blog_fan_collector venue_id=5033 fontcolor=330033]`

* `street_team_collector`

  A "join the street team" widget, which acts like the normal fan
  collector widget with the "join the street team" checkbox always
  checked.

  Requires: `artist_id` or `label_id` or `venue_id`

  Optional: `bgcolor`, `fontcolor`

  Size: 434x100

  Example:
  > `[reverbnation widget=street_team_collector artist_id=3193 bgcolor=FFA017]`

* `pro_fan_collector`

  A very customizable "join the street team" widget, only for artists.

  Requires: `artist_id`

  Optional: bordercolor,
  * `street_team=<true or false>` Defaults to false.
      * `true` &mdash; All email addresses entered join the street team.
      * `false` &mdash; A "Join the street team" checkbox is displayed.
  * `skin_id=<One of PWFS500N, where N goes from 1 to 7>`
      * `PWFS5001` &mdash; Tiny Spaces
      * `PWFS5002` &mdash; Standard Strong
      * `PWFS5003` &mdash; Reverb Classic
      * `PWFS5004` &mdash; Electro Green
      * `PWFS5005` &mdash; Sketched
      * `PWFS5006` &mdash; Big Button
      * `PWFS5007` &mdash; Big Button Light
  * `width=<number>` Defaults to 262.
  * `height=<number>` Defaults to 200.

  Size: varies

  Example:
  > `[reverbnation widget=pro_fan_collector artist_id=2105 skin_id=PWFS5005 width=434 height=100]`

= Misc. =

* `grab_box`

  A widget allowing a fan to get the embed code for other widgets.

  Requires: `artist_id`

  Optional: `bgcolor`, `fontcolor`

  Size: 300x300

  Example:
  > `[reverbnation widget=grab_box artist_id=149]`

* `press`

  A widget displaying an artist's press quotes.

  Requires: `artist_id`

  Optional: `bgcolor`, `fontcolor`

  Size: 434x110

  Example:
  > `[reverbnation widget=press artist_id=149 bgcolor=DEDBEF]`

* `pro_press`

  A very customizable version of the press widget, only for artists.

  Requires: `artist_id`

  Optional: `bgcolor`, bordercolor, `fontcolor`, 
  * `skin_id=<One of PWPS400N, where N goes from 1 to 7>`
      * `PWPS4001` &mdash; Tiny Spaces
      * `PWPS4002` &mdash; Standard Strong
      * `PWPS4003` &mdash; Reverb Classic
      * `PWPS4004` &mdash; Electro Green
      * `PWPS4005` &mdash; Sketched
      * `PWPS4006` &mdash; Big Button
      * `PWPS4007` &mdash; Big Button Light
  * `width=<number>` Defaults to 262.
  * `height=<number>` Defaults to 200.

  Size: varies

  Example:
  > `[reverbnation widget=pro_press artist_id=149 fontcolor=00FF00]`

* `fan_exclusives`

  A widget allowing a fan to download an artist's tracks which are
  exclusively meant for members of their mailing list.

  Requires: `artist_id`

  Optional: `bgcolor`, `fontcolor`

  Size: 180x130

  Example:
  > `[reverbnation widget=fan_exclusives artist_id=149]`

* `store`

  A widget allowing a user to buy merch from an artist's store.

  Requires: `artist_id`, `store_id`

  Optional:
  * `width=<number>` Defaults to 350.
  * `height=<number>` Defaults to 434.

  Size: varies

  Example:
  > `[reverbnation widget=store artist_id=149 store_id=6817]`

* `local_charts`

  Display a list of the most popular ReverbNation bands in a
  particular area.

  Required: none

  Optional: `bgcolor`, `fontcolor`
  * `title=<title for the widget>` Defaults to "Music Charts".
  * `subtitle=<subtitle for the widget>` Defaults to blank.
  * `latitude=<number>` Defaults to 35.9989014
  * `longitude=<number>` Defaults to -78.899063
  * `distance=<number>` Range in miles around lat / long to include. Defaults to 25.
  * `genres=<list of genres>` Defaults to all.

  Size: 434x285

  Example:
  > `[reverbnation widget=local_charts title="Awesome Music" subtitle="Bird In Hand, PA" latitude=40.039181 longitude=-76.196022 distance=30 genres="Rock,Hip Hop,Folk"]`

== Installation ==

1. Copy the `reverbnation-widgets` directory into directory `/wp-content/plugins/`;
1. Ativate the plugin within the 'Plugins' menu in WordPress;
1. Use the `[reverbnation]` shortcode in your templates and/or posts: see Syntax in the Other Notes section.

== Frequently Asked Questions ==

= When will this plugin be available on wordpress.com? =

ReverbNation is working to make this plugin become available on
wordpress.com, but as yet there is no word on when this will happen.

== Screenshots ==

1. player-widget.png
2. tune-widget.png

== ChangeLog ==

= 1.0 =
* Initial version.

== Upgrade Notice ==

= 1.0 =
Initial version.
 
== Support ==

For support with the installation or use of this plugin, please email
us at support@reverbnation.com .  Also, you can leave a comment on our
forums at http://forum.reverbnation.com .
