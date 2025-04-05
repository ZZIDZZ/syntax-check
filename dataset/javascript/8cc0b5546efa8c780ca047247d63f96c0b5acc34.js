function(w) {
    let vow = /[aeiouy]$/;
    let chars = w.split('');
    let before = '';
    let after = '';
    let current = '';
    for (let i = 0; i < chars.length; i++) {
      before = chars.slice(0, i).join('');
      current = chars[i];
      after = chars.slice(i + 1, chars.length).join('');
      let candidate = before + chars[i];

      //it's a consonant that comes after a vowel
      if (before.match(ends_with_vowel) && !current.match(ends_with_vowel)) {
        if (after.match(starts_with_e_then_specials)) {
          candidate += 'e';
          after = after.replace(starts_with_e, '');
        }
        all.push(candidate);
        return doer(after);
      }

      //unblended vowels ('noisy' vowel combinations)
      if (candidate.match(ends_with_noisy_vowel_combos)) { //'io' is noisy, not in 'ion'
        all.push(before);
        all.push(current);
        return doer(after); //recursion
      }

      // if candidate is followed by a CV, assume consecutive open syllables
      if (candidate.match(ends_with_vowel) && after.match(starts_with_consonant_vowel)) {
        all.push(candidate);
        return doer(after);
      }
    }
    //if still running, end last syllable
    if (str.match(aiouy) || str.match(ends_with_ee)) { //allow silent trailing e
      all.push(w);
    } else {
      all[all.length - 1] = (all[all.length - 1] || '') + w; //append it to the last one
    }
    return null;
  }