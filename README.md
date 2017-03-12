Greeklish Slugs
======================
##Converts greek characters to latin characters (greeklish).
Translitaration of greek characters to latin for post permalinks with some extra options. (greeklish)

Using [greeklish-permalinks](https://github.com/dyrer/greeklish-permalinks) with some extra functionality.

### Features

* Converts post, pages, taxonomy and category slugs to greeklish automatically
* Hooks in the sanitize_title() function
* You can use ```skp_greeklish_slugs($your_text)``` in your template files (good for dynamic css classes etc.)
* Select to strip out 1 letter words
* Select to strip out 2 letter words
* Define stop words that will be striped out of the slugs
* You can modify the translitaration array of regex via ```apply_filter('skp_greeklish_slugs_regex', 'your_callback')```

### Options Page

![Options page example](http://i.imgur.com/YCCMkIp.png)

[noveldigital.pro](https://noveldigital.pro)
