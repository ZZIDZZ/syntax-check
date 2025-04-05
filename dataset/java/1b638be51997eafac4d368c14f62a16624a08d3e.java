private void returnToPool() {
      if(pool != null) {
         try {
            pool.returnObject(this);
         } catch (Exception e1) {
            log.error("Exception :", e1);
         }
         this.pool = null;
      }
   }