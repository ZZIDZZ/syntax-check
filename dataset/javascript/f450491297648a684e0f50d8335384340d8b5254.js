function append(str, prefix = '') {
  const item = document.createElement('li');

  item.textContent = prefix + str;
  list.appendChild(item);
}