public boolean hasNext() {
      for (; index < iters.length; index++) {
         if (iters[index] != null && iters[index].hasNext()) {
            return true;
         }
      }

      return false;
   }