// 100% Offline Instant Poki SDK Mock
(function() {
  'use strict';
  var noop = function() {};
  var resolvePromise = function(val) { return Promise.resolve(val); };

  window.PokiSDK = {
    init: function() { return resolvePromise(); },
    initWithVideoHB: function() { return resolvePromise(); },
    customEvent: noop,
    commercialBreak: function() { return resolvePromise(); },
    rewardedBreak: function() { return resolvePromise(false); },
    displayAd: function(e, t, o, i) { if (o) o(); if (i) i(true); },
    destroyAd: noop,
    getLeaderboard: function() { return resolvePromise(); },
    getSharableURL: function() { return resolvePromise(""); },
    getURLParam: function() { return ""; },
    getLanguage: function() { return (navigator.language || "en").toLowerCase().split("-")[0]; },
    isAdBlocked: function() { return false; },
    disableProgrammatic: noop,
    gameLoadingStart: noop,
    gameLoadingFinished: noop,
    gameInteractive: noop,
    roundStart: noop,
    roundEnd: noop,
    muteAd: noop,
    setDebug: noop,
    gameplayStart: noop,
    gameplayStop: noop,
    gameLoadingProgress: noop,
    happyTime: noop,
    setPlayerAge: noop,
    togglePlayerAdvertisingConsent: noop,
    logError: noop,
    sendHighscore: noop,
    setDebugTouchOverlayController: noop,
    measure: noop,
    captureError: noop,
    setLogging: noop,
    setPlaytestCanvas: noop,
    getUser: function() { return resolvePromise({}); },
    getToken: function() { return resolvePromise(""); },
    login: function() { return resolvePromise(); }
  };
})();
