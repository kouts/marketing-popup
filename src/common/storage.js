const setObject = function(key, value) {
  localStorage.setItem(key, JSON.stringify(value));
};

const getObject = function(key) {
  const value = localStorage.getItem(key);
  return value && JSON.parse(value);
};

export { setObject, getObject };
