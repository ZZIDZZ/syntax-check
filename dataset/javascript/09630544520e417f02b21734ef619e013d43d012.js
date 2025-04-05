function Light(constr) {
    this.client = constr.client;

    this.ipAddress = constr.ipAddress;
    this.serialNumber = constr.serialNumber;
    this.productId = constr.productId;                  //devicetype

    this.lastSeen = constr.lastSeen;
    this.isReachable = constr.isReachable;

    this.name = constr.name;                            //devicename
    this.groupName = constr.groupName;                  //groupname
    this.groupNumber = constr.groupNumber;              //groupnumber

    this.mode = constr.mode;                            //mode
    this.brightness = constr.brightness;                //brightness
    this.ambientColor = constr.ambientColor;            //ambientr ambientg ambientb
    this.ambientShow = constr.ambientShow;              //ambientscene
    this.ambientModeType = constr.ambientModeType;      //
    this.hdmiInput = constr.hdmiInput;                  //hdmiinput
    this.hdmiInputName1 = constr.hdmiInputName1;        //hdminame1
    this.hdmiInputName2 = constr.hdmiInputName2;        //hdminame2
    this.hdmiInputName3 = constr.hdmiInputName3;        //hdminame3
}