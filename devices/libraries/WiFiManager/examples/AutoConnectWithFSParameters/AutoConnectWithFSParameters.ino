#include <Wire.h>
#include <FS.h>                   
#include <ESP8266WiFi.h>
#include <DNSServer.h>
#include <ESP8266WebServer.h>
#include <WiFiManager.h>   
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>
#include <Arduino_JSON.h>
#include <LiquidCrystal_I2C.h>
#include <OneWire.h>
#include <DallasTemperature.h>

#define ONE_WIRE_BUS D0
#define PompaUp  D6
#define PompaDown  D7
//define your default values here, if there are different values in config.json, they are overwritten.
char email[40] = " ";
char password[30] = " ";
char host_ip[15] = " ";
char id_device[10] = " ";

const long interval = 10; //5000
unsigned long previousMillis = 0;
//flag for saving data
String response;
bool shouldSaveConfig = false;
LiquidCrystal_I2C lcd(0x27, 16, 2);
OneWire oneWire(ONE_WIRE_BUS);
DallasTemperature sensors(&oneWire);

// variebel
const int ph_Pin = A0;
const int pinBuzzer = 15;
float Po = 0;
float PH_step;
int nilai_analog_PH;
double TeganganPh;
float PH4 = 3.226;
float PH7 = 2.691;

// class variebel
void postHttp();
void PH();
void sendData();
void kontrol();

//callback notifying us of the need to save config
void saveConfigCallback () {
  Serial.println("Should save config");
  shouldSaveConfig = true;
}

void setup() {
  pinMode(ph_Pin, INPUT);
  pinMode(pinBuzzer, OUTPUT);
  pinMode(PompaUp, OUTPUT);
  pinMode(PompaDown, OUTPUT);
  // put your setup code here, to run once:
  Serial.begin(115200);
  lcd.init();
  lcd.backlight();
  Serial.println();

  //clean FS, for testing
  //SPIFFS.format();

  //read configuration from FS json
  Serial.println("mounting FS...");

  if (SPIFFS.begin()) {
    Serial.println("mounted file system");
    if (SPIFFS.exists("/config1.json")) {
      //file exists, reading and loading
      Serial.println("reading config file");
      File configFile = SPIFFS.open("/config1.json", "r");
      if (configFile) {
        Serial.println("opened config file");
        size_t size = configFile.size();
        // Allocate a buffer to store contents of the file.
        std::unique_ptr<char[]> buf(new char[size]);

        configFile.readBytes(buf.get(), size);

#ifdef ARDUINOJSON_VERSION_MAJOR >= 6
        DynamicJsonDocument json(1024);
        auto deserializeError = deserializeJson(json, buf.get());
        serializeJson(json, Serial);
        if ( ! deserializeError ) {
#else
        DynamicJsonBuffer jsonBuffer;
        JsonObject& json = jsonBuffer.parseObject(buf.get());
        json.printTo(Serial);
        if (json.success()) {
#endif
          Serial.println("\nparsed json");
          strcpy(email, json["email"]);
          strcpy(password, json["password"]);
          strcpy(host_ip, json["host_ip"]);
          strcpy(id_device, json["id_device"]);
        } else {
          Serial.println("failed to load json config");
        }
        configFile.close();
      }
    }
  } else {
    Serial.println("failed to mount FS");
  }
  WiFiManagerParameter custom_email("email", "email", email, 40);
  WiFiManagerParameter custom_password("password", "password", password, 30);
  WiFiManagerParameter custom_host_ip("host_ip", "host_ip", host_ip, 15);
  WiFiManagerParameter custom_id_device("id_device", "id_device", id_device, 10);
  

  
  WiFiManager wifiManager;


  wifiManager.setSaveConfigCallback(saveConfigCallback);

  
  wifiManager.addParameter(&custom_email);
  wifiManager.addParameter(&custom_password);
  wifiManager.addParameter(&custom_host_ip);
  wifiManager.addParameter(&custom_id_device);

  if (!wifiManager.autoConnect("SmartPh", "password")) {
    Serial.println("failed to connect and hit timeout");
    delay(3000);
    
    ESP.reset();
    delay(5000);
  }

  
  Serial.println("connected...yeey :)");


  strcpy(email, custom_email.getValue());
  strcpy(password, custom_password.getValue());
  strcpy(host_ip, custom_host_ip.getValue());
  strcpy(id_device, custom_id_device.getValue());
  Serial.println("The values in the file are: ");
  Serial.println("\temail : " + String(email));
  Serial.println("\tpassword : " + String(password));
  Serial.println("\thost_ip : " + String(host_ip));
  Serial.println("\tid_device : " + String(id_device));
 
  if (shouldSaveConfig) {
    Serial.println("saving config");
#ifdef ARDUINOJSON_VERSION_MAJOR >= 6
    DynamicJsonDocument json(1024);
#else
    DynamicJsonBuffer jsonBuffer;
    JsonObject& json = jsonBuffer.createObject();
#endif
    json["email"] = email;
    json["password"] = password;
    json["host_ip"] = host_ip;
    json["id_device"] = id_device;

    File configFile = SPIFFS.open("/config1.json", "w");
    if (!configFile) {
      Serial.println("failed to open config file for writing");
    }

#ifdef ARDUINOJSON_VERSION_MAJOR >= 6
    serializeJson(json, Serial);
    serializeJson(json, configFile);
#else
    json.printTo(Serial);
    json.printTo(configFile);
#endif
    configFile.close();
   
  }

  Serial.println("local ip");
  Serial.println(WiFi.localIP());

  postHttp();
}

void postHttp()
{
  String url = "http://"+String(host_ip)+":80/nodemcu/public/api/login";
  HTTPClient http;

  StaticJsonDocument<200> var;
  String jsonParams;
  var["email"] = email;
  var["password"] = password;

  serializeJson(var, jsonParams);
  Serial.println(jsonParams);

  http.begin(url);
  http.addHeader("Content-Type", "application/json");
  
  http.POST(jsonParams);
  response = http.getString();
  Serial.println(response);
}
void sendData()
{
  String responses;
  nilai_analog_PH = analogRead(ph_Pin);
  TeganganPh = 3.3 / 1024.0 * nilai_analog_PH;

  PH_step = (PH4 - PH7) / 3;
  Po = 7.00 + ((PH7 - TeganganPh) / PH_step);
  sensors.requestTemperatures();
  String TokenSend = "Bearer "+ response;
  HTTPClient sendData;
  sendData.begin("http://"+String(host_ip)+":80/nodemcu/public/api/send"); 
  sendData.addHeader("Authorization", TokenSend);
  sendData.addHeader("Content-Type", "application/json");
    StaticJsonDocument<200> tuf;
      String jsonPara;
      tuf["id_device"] = id_device;
      tuf["tegangan"] = TeganganPh;
      tuf["ph"] = Po;
      tuf["temp"] = sensors.getTempCByIndex(0);

      serializeJson(tuf, jsonPara);
      sendData.POST(jsonPara);
  responses = sendData.getString();
  Serial.println(responses);
  sendData.end();
  delay(200);
}
void kontrol()
{
  String Token = "Bearer "+ response;
  Serial.println(Token);
    HTTPClient control;
    control.begin("http://"+String(host_ip)+":80/nodemcu/public/api/control/"+String(id_device)); 
    control.addHeader("Authorization", Token);
    control.addHeader("Content-Type", "application/json");
    int httpCode = control.GET();

    unsigned long currentMillis = millis();
  
  if(currentMillis - previousMillis >= interval) {
      if (WiFi.status() == WL_CONNECTED) {
        if (httpCode > 0) {
            String payload = control.getString();
            JSONVar myObject = JSON.parse(payload);
    
            Serial.print("JSON object = ");
            Serial.println(myObject);
        
            JSONVar keys = myObject.keys();
        
            for (int i = 0; i < keys.length(); i++) {
                JSONVar value = myObject[keys[i]];
                Serial.print("GPIO: ");
                Serial.print(keys[i]);
                Serial.print(" - SET to: ");
                Serial.println(value);
                pinMode(atoi(keys[i]), OUTPUT);
                digitalWrite(atoi(keys[i]), atoi(value));
             }  
           previousMillis = currentMillis;    
         }
        control.end();
      }
  }
}


void loop() {

  String TokenMode = "Bearer "+ response;
  String LinkRelay;
  HTTPClient httpRelay;
  LinkRelay = "http://"+String(host_ip)+":80/nodemcu/public/api/get-kontrol";
  httpRelay.begin(LinkRelay);
  httpRelay.addHeader("Authorization", TokenMode);
  httpRelay.addHeader("Content-Type", "application/json");
  httpRelay.GET();
  String Respon = httpRelay.getString();
  httpRelay.end();

  if(Respon.toInt() == 0)
  {
    Serial.println("Mode Otomatis");
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Status Mode");
    lcd.setCursor(0, 1);
    lcd.print("Otomatis");

    Serial.println(Po);
    Serial.println(TeganganPh);
    if(Po < 6)
    {
      Serial.println("PH ACID");
      digitalWrite(pinBuzzer, HIGH);
      digitalWrite(PompaUp, HIGH);
      digitalWrite(PompaDown, LOW);
    }
    if(Po == 6)
    {
      Serial.println("PH Normal");
      digitalWrite(pinBuzzer, LOW);
      digitalWrite(PompaUp, LOW);
      digitalWrite(PompaDown, LOW);
    }
    if(Po > 7)
    {
      Serial.println("PH Alakaline");
      digitalWrite(pinBuzzer, HIGH);
      digitalWrite(PompaDown, HIGH);
      digitalWrite(PompaUp, LOW);
    }

  }else{
    Serial.println("Mode Manual");
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Status Mode");
    lcd.setCursor(0, 1);
    lcd.print("Manual");
    kontrol();
  }
  sendData();

}
