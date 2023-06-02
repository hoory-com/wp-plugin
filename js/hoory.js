window.hoorySettings = {
  locale: hoory_widget_locale,
  type: hoory_widget_type,
  position: hoory_widget_position,
  launcherTitle: hoory_launcher_text,
};

(function(d,t) {
  var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.async=!0;
  g.defer=!0;
  g.src=hoory_url+"/packs/js/sdk.js";
  s.parentNode.insertBefore(g,s);
  g.onload=function(){
    window.hoorySDK.run({ websiteToken: hoory_token, baseUrl: hoory_url })
  }
})(document,"script");
