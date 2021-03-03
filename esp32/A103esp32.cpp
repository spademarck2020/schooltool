#include <WiFi.h>
#include <PubSubClient.h>
#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 21
#define RST_PIN 3
MFRC522 mfrc522(SS_PIN, RST_PIN);  


const char* ssid = "forThesisPurposes";
const char* password = "greenhouse";

const char* mqtt_server = "192.168.1.10";

WiFiClient espClient;
PubSubClient client(espClient);
long lastMsg = 0;

const int relayPin = 9;
const int buzzerPin = 5;
bool isOn = false;

const int rfid[13] = {"C9 6B 6A B9","66 37 7F 25","DB 64 AC 21",
                        "2A 46 32 00","5B 50 FC 27","CA DE 6A 01",
                        "7A B2 83 00","5A 7A 6B 01","DA 8A 5B 01",
                        "DB D3 BB 28","1B BF C0 28","DB ED 3C 25",
                        "EB F0 86 22"};

void setup() {

    setup_wifi();
    espClient.setServer(mqtt_server, 1883);
    mfrc522.PCD_Init();
    Serial.println("Approximate your card to the reader...");
    Serial.println();

    pinMode(relayPin, OUTPUT);
    pinMode(buzzerPin, OUTPUT);
}

void setup_wifi() {
  delay(10);
  // We start by connecting to a WiFi network
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}


void reconnect() {
  while (!client.connected()) {
    Serial.print("Attempting MQTT connection...");
    if (client.connect("ESP8266Client")) {
      Serial.println("connected");
      // Subscribe
      client.subscribe("rfid/a103");
    } else {
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" try again in 5 seconds");
      delay(5000);
    }
  }
}

void loop() {
  if (!client.connected()) {
    reconnect();
  }
  client.loop();

  long now = millis();
  if (now - lastMsg > 5000) {
    lastMsg = now;
    
    if ( ! mfrc522.PICC_IsNewCardPresent()) {
    return;
    }
  // Select one of the cards
    if ( ! mfrc522.PICC_ReadCardSerial()) {
    return;
    }
  //Show UID on serial monitor
    Serial.print("UID tag :");
    String content= "";
    byte letter;
    for (byte i = 0; i < mfrc522.uid.size; i++) {
     Serial.print(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " ");
     Serial.print(mfrc522.uid.uidByte[i], HEX);
     content.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? " 0" : " "));
     content.concat(String(mfrc522.uid.uidByte[i], HEX));
    }
    Serial.println();
    Serial.print("Message : ");
    content.toUpperCase();
    for(int i = 0; i < sizeof(rfid)/sizeof(rfid[0]); i++){
        if (content.substring(1) == rfid[i] && !isOn){
            String message = rfid[i] + " IN";
            Serial.println("Authorized access");
            client.publish("rfid/a103", message);
            digitalWrite(buzzerPin,HIGH);
            delay(3000);
            digitalWrite(buzzerPin,LOW);
            delay(2000);
            digitalWrite(buzzerPin,HIGH);
            delay(3000);
            digitalWrite(buzzerPin,LOW);
            delay(2000);
            digitalWrite(buzzerPin,HIGH);
            delay(3000);
            digitalWrite(buzzerPin,LOW);
            delay(2000);
            digitalWrite(relayPin, HIGH);
            isOn = true;
        }
        else if(content.substring(1) == rfid[i] && isOn){
            String message = rfid[i] + " OUT";
            Serial.println("Authorized access");
            client.publish("rfid/a103", message);
            digitalWrite(buzzerPin,HIGH);
            delay(1000);
            digitalWrite(buzzerPin,LOW);
            delay(1000);
            digitalWrite(buzzerPin,HIGH);
            delay(1000);
            digitalWrite(buzzerPin,LOW);
            delay(1000);
            digitalWrite(buzzerPin,HIGH);
            delay(1000);
            digitalWrite(buzzerPin,LOW);
            delay(10000);
            digitalWrite(relayPin, LOW);
            isOn = false;
        }
        else{
            Serial.println(" Access denied");
            delay(3000);
        }
    }
  }
}
