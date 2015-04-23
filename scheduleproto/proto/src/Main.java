import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Random;

public class Main {

    public static void main(String[] args) {   	
        int N = 6;//Integer.parseInt(args[0]);   // number of items
        int W = 10;//Integer.parseInt(args[1]);   // maximum weight of knapsack

        int[] profit = new int[N+1];
        int[] weight = new int[N+1];

        Random r = new Random();
        
        int[] drivers = new int[r.nextInt(3)+1];
        boolean[] students = new boolean[r.nextInt(3)+1];
        
        int studentsPerDriver = students.length/drivers.length;
        int counter = 0;
        
        for(int i = 0; i < drivers.length; i++){
        	drivers[i] = studentsPerDriver;
        	counter+= studentsPerDriver;
        }
        
        int a = 0;
        while(counter < students.length){
        	drivers[a] += 1;
        	a++;
        	counter += 1;
        }
        
        int [][] graph = new int[3][3];
        
        for(int j = 0; j < graph.length; j++){
        	for(int k = 0; k < graph.length; k++){
            	graph[j][k] = k+1;
            }        	
        }
        
		String url = "jdbc:mysql://104.131.179.153:3306/"; 
		String dbName = "Scheduler";
		String driver = "com.mysql.jdbc.Driver";
		String userName = "web"; 
		String password = "cea"; 
		
		ArrayList<Stop> stops = new ArrayList<Stop>();
		
		try { 
			Class.forName(driver).newInstance();
			Connection conn = DriverManager.getConnection(url+dbName,userName,password);
			System.out.println("connection successful");
			
			//start db shit
			Statement st = conn.createStatement();
			String sql = ("SELECT * FROM Users;");
			ResultSet rs = st.executeQuery(sql);
			while(rs.next()) { 
			 //int id = rs.getInt("ID"); 
			 //String str1 = rs.getString("Name");
			 //System.out.println(str1 + "'s ID is " + id);
			} 
			
			st = conn.createStatement();
			sql = ("SELECT * FROM Stops;");
			rs = st.executeQuery(sql);
			while(rs.next()) {
				if(rs.getInt("ID") == 4 || rs.getInt("ID") == 8){
					stops.add(new Stop(rs.getString("Place"), rs.getDouble("Latitude"), rs.getDouble("Longitude")));
				}
			} 
			//end db shit
			
			System.out.println("dist: " + stops.get(0).getDistance(stops.get(1)) + "miles");
			
			conn.close(); 
		} 
		catch (Exception e) { 
			e.printStackTrace(); 
		}
        
        counter = 0;
        int maxIndex = 0;
        int maxStudents = 0;
        int [] usedIndex = {-1, -1, -1};
        boolean used = false;
}
    
    private static int findFactorial(int i){
    	if(i < 2){
    		return 1;
    	}
    	else if(i == 2){
    		return 2;
    	}
    	
    	else{
    		return i*findFactorial(i - 1);
    	}
    }

    private static void scraps(){
    	int counter = 0;
        boolean[] students = {true};
        int[] drivers = {1};
        int[] usedIndex = {1};
        boolean used = false;
        int maxStudents = 1;
        int maxIndex = 1;
        
        int N = 6;//Integer.parseInt(args[0]);   // number of items
        int W = 10;//Integer.parseInt(args[1]);   // maximum weight of knapsack

        int[] profit = new int[N+1];
        int[] weight = new int[N+1];
        
        Random r = new Random();
        
    	while(counter < students.length){
        	for(int i = 0; i < drivers.length; i++){
        		for(int j = 0; j <= counter; j++){
    				used = (i == usedIndex[j]);
    				if(used){
    					break;
    				}
    			}
        		
        		if(!used && drivers[i] >= maxStudents){    			
       				maxIndex = i;
       				maxStudents = drivers[maxIndex];
        		}
        	}
        	
        	if(!used){
        		//schedulize
        		if(drivers[maxIndex] < 2 && false){
        			//straight up
        		}
        		
        		else{
        			int remainingStudents = 0;
        			for(int i = 0; i < students.length; i++){
        				if(!students[i]){
        					remainingStudents++;
        				}
        			}
        			
        			remainingStudents = 4;
        			drivers[maxIndex] = 3;
        			
        			//int generalCombinations = findFactorial(remainingStudents)/(findFactorial(drivers[maxIndex])*findFactorial(remainingStudents-drivers[maxIndex]));
        			//int permsOfCombos = findFactorial(drivers[maxIndex]*2)/(drivers[maxIndex]*findFactorial(drivers[maxIndex]));


        		
        		
        		
        		usedIndex[counter] = maxIndex;
        		maxStudents = 0;
        		counter++;
        	}
        }
        
        
        // generate random instance, items 1..N
        for (int n = 1; n <= N; n++) {
            profit[n] = (int) (r.nextInt(10));
            weight[n] = (int) (r.nextInt(10));
        }

        // opt[n][w] = max profit of packing items 1..n with weight limit w
        // sol[n][w] = does opt solution to pack items 1..n with weight limit w include item n?
        int[][] opt = new int[N+1][W+1];
        boolean[][] sol = new boolean[N+1][W+1];

        for (int n = 1; n <= N; n++) {
            for (int w = 1; w <= W; w++) {

                // don't take item n
                int option1 = opt[n-1][w];

                // take item n
                int option2 = Integer.MIN_VALUE;
                if (weight[n] <= w) option2 = profit[n] + opt[n-1][w-weight[n]];

                // select better of two options
                opt[n][w] = Math.max(option1, option2);
                sol[n][w] = (option2 > option1);
            }
        }

        // determine which items to take
        boolean[] take = new boolean[N+1];
        for (int n = N, w = W; n > 0; n--) {
            if (sol[n][w]) { take[n] = true;  w = w - weight[n]; }
            else           { take[n] = false;                    }
        }

        // print results
        System.out.println("item" + "\t" + "profit" + "\t" + "weight" + "\t" + "take");
        for (int n = 1; n <= N; n++) {
            System.out.println(n + "\t" + profit[n] + "\t" + weight[n] + "\t" + take[n]);
        	}
    	}
    }
}