import { isMobileDevice } from '@/common/is-mobile-device';

const isDesktop = !isMobileDevice();

function createExitIntent(options) {
  if (!options.name) {
    throw new Error('You must provide a name as a unique identifier.');
  }

  const defaults = {
    onTrigger: function() {}
  };
  const opts = Object.assign({}, defaults, options);

  function trigger() {
    opts.onTrigger();
  }

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
      trigger();
    }
  };

  function beforeUnloadHandler(e) {
    trigger();
    e.preventDefault();
    // Chrome requires returnValue to be set.
    e.returnValue = '';
  }

  const exitIntent = {
    init() {
      window.addEventListener('beforeunload', beforeUnloadHandler);
      if (isDesktop) {
        document.addEventListener('mouseout', mouseOutHandler);
      }
    },
    destroy() {
      console.log('Destroyed');
      document.removeEventListener('mouseout', mouseOutHandler);
      window.removeEventListener('beforeunload', beforeUnloadHandler);
    },
    trigger() {
      trigger();
    }
  };

  return exitIntent;
};

export { createExitIntent };
