import { isTouchDevice } from '@/common/is-touch-device';

const isDesktop = !isTouchDevice();

function createExitIntent(options) {
  const defaults = {
    onTrigger: function(str) {
      console.log(str || 'triggered');
    }
  };
  const opts = Object.assign({}, defaults, options);

  function mouseOutHandler(e) {
    // If the mouse is near the top of the window (50px) fire the exit intent
    // clientY: Vertical coordinate within the application's client area at which the event occurred (as opposed to the coordinate within the page).
    // relatedTarget: The EventTarget the pointing device entered (when out of the document === null)
    // Do NOT trigger when hovering or clicking on selects (Firefox bug)
    // console.log(e.clientY);
    // console.log(e.relatedTarget);
    if (e.clientY < 50 && e.relatedTarget === null && e.target.nodeName.toLowerCase() !== 'select') {
      // Remove this event listener
      // document.removeEventListener('mouseout', mouseOutHandler);

      // Fire the exit intent
      opts.onTrigger('mouseOutHandler');
    }
  };

  const exitIntent = {
    init() {
      document.body.setAttribute('data-exit-intent', true);
      if (isDesktop) {
        document.addEventListener('mouseout', mouseOutHandler);
      }
    },
    destroy() {
      console.log('destroyed');
      document.removeEventListener('mousemove', mouseOutHandler);
    }
  };

  return exitIntent;
};

export { createExitIntent };
