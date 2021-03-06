
public class Stop {

	private double latitude;
	private double longitude;
	
	private String place;
	
	public Stop(String place, double latitude, double longitude){
		this.latitude = latitude;
		this.longitude = longitude;
		this.place = place;
	}

	public double getLatitude() {
		return latitude;
	}

	public void setLatitude(double latitude) {
		this.latitude = latitude;
	}

	public double getLongitude() {
		return longitude;
	}

	public void setLongitude(double longitude) {
		this.longitude = longitude;
	}

	public String getPlace() {
		return place;
	}

	public void setPlace(String place) {
		this.place = place;
	}

	public double getDistance(Stop placeToGo){
		double theta = this.longitude - placeToGo.getLongitude();
		double dist = Math.sin(deg2rad(this.latitude)) * Math.sin(deg2rad(placeToGo.getLatitude()))
				+ Math.cos(deg2rad(this.latitude)) * Math.cos(deg2rad(placeToGo.getLatitude())) * Math.cos(deg2rad(theta));
		dist = Math.acos(dist);
		dist = rad2deg(dist);
		dist = dist * 60 * 1.1515;
		//to kilos
		//dist = dist * 1.609344;
		
		return dist;
	}
	
	private double deg2rad(double deg){
		return (deg*Math.PI/180d);
	}
	
	private double rad2deg(double rad){
		return (rad*180d/ Math.PI);
	}
	
}
