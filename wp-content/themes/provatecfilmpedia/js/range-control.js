const ranges = document.querySelectorAll('input[type="range"]');

ranges.forEach((range) => {
  // Establir propietats
  range.disabled = true;
  range.min = 0;
  range.max = 10;
  
  // Establir variable CSS '--progress'
  const value = range.value;
  const percentage = (value / 10) * 100;
  range.style.setProperty('--progress', `${percentage}%`);
});
