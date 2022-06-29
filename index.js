const { exists } = require("laravel-mix/src/File");
const puppeteer = require("puppeteer");
const fs = require('fs');
var mysql = require('mysql');

require('dotenv').config({ path: '.env' });

(async () => {
 

    function onlyUnique(value, index, self) {
        return self.indexOf(value) === index;
    }
    var propertylist = [];
    let browser = await puppeteer.launch({
        args: ["--no-sandbox"]
    });
    var con = mysql.createConnection({
        host: process.env.DB_HOST,
        port: process.env.DB_PORT,
        user: process.env.DB_USERNAME,
        password: process.env.DB_PASSWORD,
        database: process.env.DB_DATABASE,
        connectionLimit: 10
    });
    
    con.connect(function(err) {
        if (err) throw err;
    });
    const mainpage =  await browser.newPage()
    //  await mainpage.goto(process.argv.slice(2)[1])
    await mainpage.goto('https://www.zameen.com/Profile/Lahore-360_Real_Estate-186617-1.html')
 
   
    
    var url = await mainpage.evaluate(()=>{
       return Array.from(document.querySelectorAll(".viewall")).map(x => x.href)
   
    })
  

  var purl =url;

///Set url to get all rental property
   var renturl = "&load_all_prop=1";
  for (m=0; m<purl.length; m++)
{
    

    let page1 = await browser.newPage();
    if(m==1)
    {
    await page1.goto(purl[m]+renturl, {
        waitUntil: "networkidle2",timeout:0
    });
    }
    else{
        await page1.goto(purl[m], {
            waitUntil: "networkidle2",timeout:0
        }); 
    }
    var leng = await page1.evaluate(() => { 
        return document.querySelectorAll(
            "#body-wrapper > main > div > div > div > div > div > ul > li"
        ).length;
    });
    const firstpage = await page1.$$eval(
        "#body-wrapper > main > div.aeb96d72 > div > div > div > ul>li>article>div>a",
        (el) => el.map((x) => x.getAttribute("title"))
    );

    propertylist = await page1.$$eval(
        "#body-wrapper > main > div > div > div > div > div > ul > li > a",
        (el) => el.map((x) => x.href)
    );
  
    var unique= [];

    var unique = propertylist.filter(onlyUnique);
    if(m==1)
    {
    unique.push(purl[m]+renturl);
    }
    else{
    unique.push(purl[m]);

    }


    var rows = [];
    for (let k = 0; k < unique.length; k++) {
        let propetryurl = unique[k];

      
        let page = await browser.newPage();
        await page.goto(propetryurl, {
            waitUntil: "networkidle2",timeout:0
        });
        var length = await page.evaluate(() => {
            return document.querySelectorAll(
                "#body-wrapper > main > div > div > div > div > div > ul > li"
            ).length;
        });
        // console.log(propetryurl);
        // process.exit(1);


        var rows = await page.$$eval(
            "#body-wrapper > main > div.aeb96d72 > div > div > div > ul>li>article>div>a",
            (el) => el.map((x) => x.href)
        );

        for (j = 0; j < rows.length; j++) {
            var dta = rows[j].split(" ");
            let individualurl = dta[0];
            console.log(individualurl);

            let page4 = await browser.newPage();

            await page4.goto(individualurl, {
                waitUntil: "networkidle2",timeout:0
            });
            await page4.waitForTimeout(5000);

            await page4.waitForSelector('#body-wrapper > main > div > div > div > h1')
            
            let element = await page4.$('#body-wrapper > main > div > div > div > h1')
            let typedata = await page4.$('#body-wrapper > main > div > div > div > div > div > ul > li > span._812aa185')
            let locationdata = await page4.$('#body-wrapper > main > div > div > div > div > div > ul > li:nth-child(3) > span._812aa185')
            let areadata = await page4.$('#body-wrapper > main > div > div > div > div > div > ul > li > span > span')
            //dynamic class added for price and purpose
          
            let pricedata = await page4.$('#body-wrapper > main > div > div > div > div > div > ul > li:nth-child(2) > span._812aa185')
            let purposedata = await page4.$('#body-wrapper > main > div > div > div > div > div > ul > li:nth-child(6) > span._812aa185')
            let roomdata = await page4.$('#body-wrapper > main > div > div > div > div > div > ul > li:nth-child(7) > span._812aa185')
            var yearbuiltdata = await page4.$('#body-wrapper > main > div > div > div > div > div > div > div > ul > li > ul > li > span')
            if(!yearbuiltdata)
            {
                var yearbuiltdata = await page4.$('#body-wrapper > main > div > div > div > div > div > ul > li > ul > li > span')
            }
            let bathroomdata = await page4.$('#body-wrapper > main > div > div > div > div > div > ul > li:nth-child(4) > span._812aa185')
           
            
            let descriptiondata = await page4.$('#body-wrapper > main > div > div > div > div > div > div > div > div > div > span')
       
            var type = await page4.evaluate(el => el.innerText, typedata)
            var category_id = 0;
            var subcategory_id = 0;


            switch (type) {
   
  
                case 'House':
                     category_id = 1;
                     subcategory_id = 1;
                break;
                case 'Flat':
                 category_id = 1;
            
                 subcategory_id = 2;
                break;
                case 'Upper Portion':
                 category_id = 1;
            
                 subcategory_id = 3;
            
                break;
                case 'Farm House':
                 category_id = 1;
            
                 subcategory_id = 5;
                break;
                case 'Penthouse':
                 category_id = 1;
            
                 subcategory_id = 7;
            
                break;
                case 'Lower Portion':
                 category_id = 1;
            
                 subcategory_id = 4;
            
                break;
                case 'Room':
                 category_id = 1;
            
                 subcategory_id = 6;
                break;
            
                case 'Residential Plot':
                   category_id = 2;
                   subcategory_id = 8;
                break;
                case 'Agricultural Land':
                   category_id = 2;
                   subcategory_id = 10;
                break;
                case 'Plot File':
                   category_id = 2;
                   subcategory_id = 12;
                break;
                case 'Commercial Plot':
                   category_id = 2;
                   subcategory_id = 9;
                break;
                case 'Industrial Land':
                   category_id = 2;
                   subcategory_id = 11;
                break;
                case 'Plot Form':
                   category_id = 2;
                   subcategory_id = 13;
                break;
                case 'Office':
                   category_id = 3;
                   subcategory_id = 14;
            
                break;
                case 'Warehouse':
                   category_id = 3;
                   subcategory_id = 16;
            
                break;
                case 'Building':
                   category_id = 3;
                   subcategory_id = 18;
            
                break;
                case 'Shop':
                   category_id = 3;
                   subcategory_id = 15;
            
                break;
                case 'Factory':
                   category_id = 3;
                   subcategory_id = 17;
            
                break;
                case 'Other':
                   category_id = 3;
                   subcategory_id = 19;
                break; 
                default:
                    category_id = null;
                   subcategory_id = null;
           

            
            }
      
    
            var title = await page4.evaluate(el => el.textContent, element)
            var area = await page4.evaluate(el => el.textContent, areadata)
            var price = await page4.evaluate(el => el.textContent, pricedata)
            var streetaddress = await page4.$('#body-wrapper > main > div > div > div.b72558b0 > div')
            var streetaddress = await page4.evaluate(el => el.textContent, streetaddress)
            console.log(streetaddress);
            
            if(area.match("Square Feet"))
            {
                var unit_id = 1;
            }
            else if(area.match("Square Meters"))
            {
                var test = area.match(/-?(?:\d+(?:\.\d*)?|\.\d+)/);
                
                var area = test[0]*10.7639;
                var unit_id = 2;

            
            }
            else if(area.match("Square Yards"))
            {
                var test = area.match(/-?(?:\d+(?:\.\d*)?|\.\d+)/);
                
                var area = test[0]*9;

                var unit_id = 3;
            
            }
           
            else if(area.match("Marla"))
            {
                var test = area.match(/-?(?:\d+(?:\.\d*)?|\.\d+)/);
                var area = test[0]*272.251;
                var unit_id = 4;
            
            }
            else if(area.match("Kanal"))
            {
                var test = area.match(/-?(?:\d+(?:\.\d*)?|\.\d+)/);
                var area = test[0]*5445;

                var unit_id = 5;
            
            }
            
         
            var matches = price.match(/-?(?:\d+(?:\.\d*)?|\.\d+)/);
         
            
           
            if(price.match("Thousand"))
            {
                var price = matches[0]*1000;
        
            }
       
            else if(price.match("Lakh"))
            {
               var price = matches[0]*100000;

      
    
            }
            else if(price.match("Crore"))
            {
                var price = matches[0]*10000000;

       
            }
           

         

            var location = await page4.evaluate(el => el.textContent, locationdata)
            var purpose = await page4.evaluate(el => el.textContent, purposedata)
            var description = await page4.evaluate(el => el.textContent, descriptiondata)
    

            if(purpose == "For Sale")
            {
                purpose= 0;
            }
            else
            {
                purpose = 1;
            }

       
            if(type=='House'|| type=="Flat"|| type=="Upper Portion" || type=="Farm House" || type=="Penthouse" || type=="Lower Portion" || type=="Room")
            {
            var room = await page4.evaluate(el => el.textContent, roomdata)
       
            var bathroom = await page4.evaluate(el => el.textContent, bathroomdata)
            var parkingspace = await page4.$('#body-wrapper > main > div> div > div > div > div > div > div > ul > li > ul > li > span')

            if(parkingspace !== null)
            {
            var ps = await page4.evaluate(el => el.textContent, parkingspace)

               var parkingspace = 1;
            }

            if(yearbuiltdata)
            {
            var year = await page4.evaluate(el => el.textContent, yearbuiltdata)
           
              
            if(year.match("Built in year: "))
            {
            var yearbuilt = year.replace('Built in year: ','');
            }
            }
                                  
            var propertydetail = "INSERT INTO property_detail_drafts(parking_space,rooms, bathrooms, year_build,created_at, updated_at) VALUES ?";
            var detailvalues = [[ parkingspace,room, bathroom, yearbuilt, new Date(), new Date()]];
            
            con.query(propertydetail, [detailvalues], function (err, result) {
                if (err) {
                    console.log(err);
                    fs.writeFile('./fakeData.json', JSON.stringify(detailvalues, null, 2), err => {
                        if(err){
                          console.log(err);
                        } else {
                          console.log('File successfully written.')
                        }
                      })
                }else{
                    var address = "INSERT INTO addresses(street_address,country, location,created_at, updated_at) VALUES ?";
                    var addressvalues = [[ streetaddress,"pakistan", location, new Date(), new Date()]];
                    con.query(address, [addressvalues], function (err, results) {
                        if (err) {
                            console.log(err);
                        }else{
          
                      
                            var sql = "INSERT INTO property_drafts(title, area, price, purpose, description,property_detail_draft_id,address_id,category_id,sub_category_id,unit_id,agency_id,auth_id,user_id,created_at, updated_at) VALUES ?";
                            var values = [[ title, area, price, purpose,description,result.insertId,results.insertId,category_id,subcategory_id,unit_id,process.argv.slice(2)[0],process.argv.slice(2)[2],process.argv.slice(2)[2], new Date(), new Date()]];
                            con.query(sql, [values], function (err, result) {
                                if (err) {
                                    console.log(err);
                                }else{
                                    console.log("Number of inserted records: " + result.affectedRows);
                                    console.log('id:'+ result.insertId);
                
                                }
                            });
        
                        }
                        
                    });
                   

                }
            });
           
           
         
        }
        else
        {
            
            var address = "INSERT INTO addresses(street_address,country, location,created_at, updated_at) VALUES ?";
            var addressvalues = [[streetaddress, "pakistan", location, new Date(), new Date()]];
            con.query(address, [addressvalues], function (err, results) {
                if (err) {
                    console.log(err);
                }else{
                    
             var sql = "INSERT INTO property_drafts (title, area, price, purpose, description,address_id,category_id,sub_category_id,unit_id,agency_id,auth_id,user_id,created_at, updated_at) VALUES ?";
             var values = [[ title, area, price, purpose,description,results.insertId,category_id,subcategory_id,unit_id,process.argv.slice(2)[0],process.argv.slice(2)[2],process.argv.slice(2)[2], new Date(), new Date()]];
         
             con.query(sql, [values], function (err, result) {
                if (err) {
                    console.log(err);
                }else{
                    console.log("Number of inserted records: " + result.affectedRows);
                    console.log('id:'+ result.insertId);

                }
            });
        }
        });
        }

        }

        // process.exit(1);
        
    }
}
})();