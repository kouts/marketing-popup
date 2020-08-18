export const clone = (obj) => {
  return JSON.parse(JSON.stringify(obj));
};

export const isEmptyObject = (obj) => {
  return Object.keys(obj).length === 0 && obj.constructor === Object;
};

export const getFromList = (list, selectedValue, valueToSelect, textNameToShow) => {
  const valueSelect = valueToSelect || 'value';
  const textName = textNameToShow || 'text';
  let toret = '';
  for (let i = 0; i < list.length; i++) {
    if (list[i][valueSelect] === selectedValue) {
      toret = list[i][textName];
      break;
    }
  }
  return toret;
};
