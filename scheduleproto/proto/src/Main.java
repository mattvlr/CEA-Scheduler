import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.Random;

import com.mysql.jdbc.PreparedStatement;

public class Main {

    public static void main(String[] args) {   	        
		String url = "jdbc:mysql://104.131.179.153:3306/"; 
		String dbName = "Scheduler";
		String driver = "com.mysql.jdbc.Driver";
		String userName = "web"; 
		String password = "cea"; 
		
		ArrayList<Stop> stops = new ArrayList<Stop>();
		ArrayList<StudentTime> times = new ArrayList<StudentTime>();
		ArrayList<DriverTime> drivers = new ArrayList<DriverTime>();
		
		ArrayList<String> stopsToAdd = new ArrayList<String>();
		    	
		try { 
			Class.forName(driver).newInstance();
			Connection conn = DriverManager.getConnection(url+dbName,userName,password);
			System.out.println("connection successful");
			
			//start db shit
			//students
			Statement st = conn.createStatement();
			String sql = ("SELECT * FROM StudentTimes;");
			ResultSet rs = st.executeQuery(sql);
			while(rs.next()) { 
				if(checkDay(rs.getString("Day"))){
					times.add(new StudentTime(rs.getInt("UniversityID"), rs.getInt("RideTime"), rs.getString("PickupPlace"), rs.getString("DropPlace")));
				}
			} 

			//drivers
			st = conn.createStatement();
			sql = ("SELECT * FROM DriverTimes;");
			rs = st.executeQuery(sql);
			while(rs.next()) { 
				if(checkDay(rs.getString("DaysOfWeek"))){
					drivers.add(new DriverTime(rs.getString("FirstName") + " " + rs.getString("LastName"), rs.getInt("StartTime"), rs.getInt("EndTime")));
				}
			} 
			
			//stops
			for(StudentTime sT : times){
				if(checkStop(sT.getPickupPlace(), stopsToAdd)){
					stopsToAdd.add(sT.getPickupPlace());
				}
				if(checkStop(sT.getDropPlace(), stopsToAdd)){
					stopsToAdd.add(sT.getDropPlace());
				}
			}
			
			st = conn.createStatement();
			sql = ("SELECT * FROM Stops;");
			rs = st.executeQuery(sql);
			while(rs.next()) {
				if(stopsToAdd.contains(rs.getString("Place"))){
					stops.add(new Stop(rs.getString("Place"), rs.getFloat("Latitude"), rs.getFloat("Longitude")));
				}
			}
			
			QuickSort sorter = new QuickSort(times);
			sorter.sort();
			
			//checker data
			String lastTime = "-1";
			String lastPrimary = "";
			String lastSecondary = "";
			
			//insert
		   	for(StudentTime sT : times){
		   		// create a sql date object so we can use it in our INSERT statement
		   		Calendar calendar = Calendar.getInstance();
	        	java.sql.Date startDate = new java.sql.Date(calendar.getTime().getTime());
	        	String pickupTime = sT.getRideTime(false);
	        	String primaryDriver = (Integer.parseInt(lastTime) == Integer.parseInt(pickupTime)) ? lastPrimary : selectDriver(drivers, sT.getRideTime(), 2);
	        	String secondaryDriver = (selectDriver(drivers, sT.getRideTime(), 1) == primaryDriver) ? "No Backup" : (lastTime == pickupTime) ? lastSecondary : selectDriver(drivers, sT.getRideTime(), 1);
	        	
	        	// the mysql insert statement
	        	String query = " insert into Schedules (Driver_ID, Day, Cart, Student_First, StudentLast, Driver, PickupTime, DropTime, PickupPoint, DropPoint, BackupDriver)"
	        		+ " values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	   
	        	// create the mysql insert prepared statement
	        	PreparedStatement preparedStmt = (PreparedStatement) conn.prepareStatement(query);
	        	preparedStmt.setInt 	(1, 1);
	        	preparedStmt.setDate   	(2, startDate);
	        	preparedStmt.setString	(3, "Ol' Reliable");
	        	preparedStmt.setString	(4, getStudentName(conn, true, sT.getUniversityID()));
	        	preparedStmt.setString	(5, getStudentName(conn, false, sT.getUniversityID()));
	        	preparedStmt.setString	(6, primaryDriver);
	        	preparedStmt.setString  (7, "" + sT.getRideTime(false));
	        	preparedStmt.setString  (8, "" + (sT.getRideTime(true)));
	        	preparedStmt.setString  (9, sT.getPickupPlace());
	        	preparedStmt.setString  (10, sT.getDropPlace());
	        	preparedStmt.setString  (11, secondaryDriver);
	        
	        	// execute the prepared statement
	        	preparedStmt.execute();	         
	        	
	        	//check
	        	lastTime = pickupTime;
	        	lastPrimary = primaryDriver;
	        	lastSecondary = secondaryDriver;
		   	}
			//end db shit
			conn.close(); 
			System.out.println("connection terminated");
		} 
		catch (Exception e) { 
			e.printStackTrace(); 
		}
	}
    
    private static boolean checkDay(String dbDays){
    	Date yourDate = new Date();
    	Calendar c = Calendar.getInstance();
    	c.setTime(yourDate);
    	int dayOfWeek = c.get(Calendar.DAY_OF_WEEK);
    	
    	switch(dayOfWeek){
    	case 2:
    		return(dbDays.charAt(0) == '1');
    	case 3:
    		return(dbDays.charAt(1) == '1');
    	case 4:
    		return(dbDays.charAt(2) == '1');
    	case 5:
    		return(dbDays.charAt(3) == '1');
    	case 6:
    		return(dbDays.charAt(4) == '1');
    	}
    	    	
    	return false;
    }

    private static boolean checkStop(String stop, ArrayList<String> stops){
     	return !stops.contains(stop);
    }
    
    private static String selectDriver(ArrayList<DriverTime> drivers, int studentPickupTime, int drivingWeight){
    	int indexLeast = -1;
    	int leastTimes = Integer.MAX_VALUE;
    	int counter = 0;
    	
    	//Calendar cal = Calendar.getInstance();
    	//cal.getTime();
    	//SimpleDateFormat sdf = new SimpleDateFormat("HHmm");
    	//int currentTime = Integer.parseInt(sdf.format(cal.getTime()));
    	
    	for(DriverTime dT: drivers){
    		if(dT.getStartTime() < studentPickupTime && studentPickupTime < dT.getEndTime()){
    			if(dT.getTimesDriving() < leastTimes){
    				indexLeast = counter;
    				leastTimes = dT.getTimesDriving();
    			}
    		}
    		
    		counter++;
    	}
    	
    	if(indexLeast == -1){
    		return "No Driver";
    	}
    	
    	else{
    		drivers.get(indexLeast).incrementTimesDriving(drivingWeight);
    		return drivers.get(indexLeast).getName();
    	}
    }
    
    private static String getStudentName(Connection conn, boolean isFirst, int id){
    	try {
    		String name = "";
        	Statement st = conn.createStatement();
			String sql = ("SELECT * FROM Users WHERE UniversityID =" + id + ";");
			ResultSet rs = st.executeQuery(sql);
			while(rs.next()) { 
				if(isFirst){
					name = rs.getString("First_Name");
				}
				else{
					name = rs.getString("Last_Name");
				}
				break;
			}
			return name;
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
    	
    	return "";
    }
}