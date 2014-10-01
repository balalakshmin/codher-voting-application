package com.indix.activity;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.view.View;
import android.webkit.URLUtil;
import android.widget.ListView;
import android.widget.TextView;

import com.android.volley.toolbox.ImageLoader;
import com.android.volley.toolbox.NetworkImageView;
import com.indix.adapter.ProductDetailsAdapter;
import com.indix.app.IXMainApplication;
import com.indix.app.R;
import com.indix.model.IXProductDetails;
import com.indix.model.IXProductDetails.Atrributes;
import com.indix.network.MyVolley;
import com.indix.utils.NetworkUtils;

public class ProductDetailsActivity extends Activity {


	private String TAG = this.getClass().getSimpleName();
	private static ListView listView;
	private static ProductDetailsAdapter adapter;
	private static NetworkImageView productImage;
	private static TextView productName;
	private static TextView brandName;
	private static TextView categoryName;
	private static TextView sku;
	private static ProgressDialog progressDialog;
	private String sourcePageType;
	private String queryString;
	private static View header;

	public ProductDetailsActivity() {}


	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_product_details);
		String mPid = getIntent().getExtras().getString("mPid");

		listView = (ListView)findViewById(R.id.price_across_store_lv);	
		productName = (TextView)findViewById(R.id.product_name_tv);
		productImage = (NetworkImageView)findViewById(R.id.product_iv);

		
		brandName = (TextView)findViewById(R.id.product_brand_value_tv);
		categoryName = (TextView)findViewById(R.id.product_catgory_value_tv);
		sku = (TextView)findViewById(R.id.product_sku_value_tv);

		progressDialog = new ProgressDialog(this);
		progressDialog.setMessage("Loading");
		//progressDialog.setCancelable(false);
		progressDialog.show();
		NetworkUtils.processRequest(this, mResponseHandler, NetworkUtils.PRODUCT_DETAILS, "&mpid="+mPid,null);
		
		header = (View)getLayoutInflater().inflate(R.layout.product_details_header, null);
	    
	}


	/*
	 * Response Handler for UI Thread
	 */
	static private Handler mResponseHandler = new Handler() {
		@Override
		public void handleMessage(Message msg) {
			Bundle reply = msg.getData();
			progressDialog.dismiss();
			if(reply != null){
				boolean updateUI = reply.getBoolean("updateUI");
				if(updateUI){
					IXProductDetails details = (IXProductDetails )msg.obj;
					System.out.println(" detaills:: "+details.getTitle());

					String imageURL = details.getImageURL();
					if (URLUtil.isValidUrl(imageURL)) {						
						ImageLoader imageLoader = MyVolley.getImageLoader();
						productImage.setImageUrl(imageURL, imageLoader);
					}
					productName.setText(details.getTitle()); 
					categoryName.setText(details.getCategoryName());
					brandName.setText(details.getBrandName());
					
					Atrributes attributes = details.getAttributes();
					String skuText = attributes.getGetSku();
					System.out.println(" SKY "+skuText);
					if(skuText != null)
					sku.setText(skuText);

					IXProductDetails.StoresData[]  array =  (IXProductDetails.StoresData[])details.getAvailableStores();
					Context context = IXMainApplication.getAppContext();				
					adapter = new ProductDetailsAdapter(context,array);	
					  listView.addHeaderView(header);
				    listView.setAdapter(adapter);

				}
			}
		}
	};


}
