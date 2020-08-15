// https://patrickhlauke.github.io/touch/touchscreen-detection/

export const isTouchDevice = () => {
  let res = false;
  if (window.PointerEvent && ('maxTouchPoints' in navigator)) {
    // if Pointer Events are supported, just check maxTouchPoints
    if (navigator.maxTouchPoints > 0) {
      res = true;
    }
  } else {
    // no Pointer Events...
    if (window.matchMedia && window.matchMedia('(any-pointer:coarse)').matches) {
      // check for any-pointer:coarse which mostly means touchscreen
      res = true;
    } else if (window.TouchEvent || ('ontouchstart' in window)) {
      // last resort - check for exposed touch events API / event handler
      res = true;
    }
  }
  return res;
};
