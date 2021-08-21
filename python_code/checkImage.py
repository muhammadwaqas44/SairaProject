from skimage.metrics import structural_similarity as compare_ssim
import argparse
import imutils
import cv2
import sys

imageA = cv2.imread(sys.argv[1])
imageB = cv2.imread(sys.argv[2])
OriginalImage = sys.argv[3]
ModifiedImage = sys.argv[4]
DiffImage = sys.argv[5]
ThreshImage = sys.argv[6]

grayA = cv2.cvtColor(imageA, cv2.COLOR_BGR2GRAY)
grayB = cv2.cvtColor(imageB, cv2.COLOR_BGR2GRAY)
(score, diff) = compare_ssim(grayA, grayB, full=True)
diff = (diff * 255).astype("uint8")
print("SSIM: {}".format(score))
thresh = cv2.threshold(diff, 0, 255,
	cv2.THRESH_BINARY_INV | cv2.THRESH_OTSU)[1]
cnts = cv2.findContours(thresh.copy(), cv2.RETR_EXTERNAL,
	cv2.CHAIN_APPROX_SIMPLE)
cnts = imutils.grab_contours(cnts)
for c in cnts:
	(x, y, w, h) = cv2.boundingRect(c)
	cv2.rectangle(imageA, (x, y), (x + w, y + h), (0, 0, 255), 2)
	cv2.rectangle(imageB, (x, y), (x + w, y + h), (0, 0, 255), 2)
# cv2.imshow("Original", imageA)
# cv2.imshow("Modified", imageB)
# cv2.imshow("Diff", diff)
# cv2.imshow("Thresh", thresh)
cv2.imwrite(str(OriginalImage),imageA)
cv2.imwrite(str(ModifiedImage),imageB)
cv2.imwrite(str(DiffImage),diff)
cv2.imwrite(str(ThreshImage),thresh)
cv2.waitKey(0)
