function __ENFORCETYPE(a, ...types) {
     if (env.application_env !== "development") return;
     let hasError = false;
     let expecting;
     let got;
     let i = 0;

     types.map( (t, index) => {
         if (a[index] === null) {
             hasError = true;
             expecting = t;
             got = "null";
             i = index;
             return;
         }
         switch (t) {
             case "mixed":
             break;
             case "jsx":
             if (!React.isValidElement(a[index])) {
                 hasError = true;
                 expecting = "jsx";
                 got = typeof a[index];
                 i = index;
             }
             case "array":
             if (!Array.isArray(a[index])) {
                 hasError = true;
                 expecting = "array";
                 got = typeof a[index];
                 i = index;
             }
             break;
             case "object":
                 if (typeof a[index] !== 'object' || Array.isArray(a[index]) || a[index] === null) {
                     hasError = true;
                     expecting = "object";
                     i = index;
                     if (a[index] === null) {
                         got = 'null';
                     } else {
                         got = Array.isArray(a[index]) ? "array" : typeof a[index];
                     }

                 }

             default:
             if (typeof a[index] !== t) {
                 hasError = true;{
                 expecting = t;
                 got = typeof a[index];}
                 i = index;
             }
         }
     });

     if (hasError) {
         let err = new Error();
         console.error(`ENFORCETYPE: param ${i + 1} is expecting ${expecting} got ${got} instead.`, err.stack);
     }
 }